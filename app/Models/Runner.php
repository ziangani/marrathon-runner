<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Runner extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'age',
        'gender',
        'emergency_contact_name',
        'emergency_contact_phone',
        't_shirt_size',
        'race_category',
        'race_category_key',
        'health_condition',
        'health_condition_specify',
        'how_did_you_hear_about_us',
        'exhibiting',
        'package',
        'package_amount',
        'reference',
        'race_number',
        'status',
        'transaction_id',
        'payment_provider',
        'payment_reference',
        'payment_date',
        'email_sent',
        'sms_sent',
        'whatsapp_sent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'package_amount' => 'decimal:2',
        'payment_date' => 'datetime',
        'email_sent' => 'boolean',
        'sms_sent' => 'boolean',
        'whatsapp_sent' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Generate a unique reference when creating a new runner
        static::creating(function ($runner) {
            if (!$runner->reference) {
                $runner->reference = self::generateUniqueReference();
            }
        });
    }

    /**
     * Generate a unique reference number.
     *
     * @return string
     */
    public static function generateUniqueReference(): string
    {
        $prefix = 'LWR-';
        $reference = $prefix . strtoupper(Str::random(8));

        // Ensure the reference is unique
        while (self::where('reference', $reference)->exists()) {
            $reference = $prefix . strtoupper(Str::random(8));
        }

        return $reference;
    }

    /**
     * Generate a unique race number.
     *
     * @return string
     */
    public static function generateUniqueRaceNumber(): string
    {
        // Get the current year
        $year = date('Y');
        
        // Find the highest race number for this year
        $highestNumber = self::where('race_number', 'like', "{$year}-%")
            ->orderByRaw('CAST(SPLIT_PART(race_number, \'-\', 2) AS INTEGER) DESC')
            ->value('race_number');
        
        if ($highestNumber) {
            // Extract the number part and increment it
            $parts = explode('-', $highestNumber);
            $number = (int) end($parts);
            $number++;
        } else {
            // Start with 1 if no race numbers exist for this year
            $number = 1;
        }
        
        // Format the race number with leading zeros (e.g., 2025-0001)
        return "{$year}-" . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Mark the runner as paid.
     *
     * @param string $transactionId
     * @param string $provider
     * @param string|null $reference
     * @return bool
     */
    public function markAsPaid(string $transactionId, string $provider, ?string $reference = null): bool
    {
        $this->status = 'PAID';
        $this->transaction_id = $transactionId;
        $this->payment_provider = $provider;
        $this->payment_reference = $reference;
        $this->payment_date = now();
        
        // Generate a race number if not already assigned
        if (!$this->race_number) {
            $this->race_number = self::generateUniqueRaceNumber();
        }
        
        return $this->save();
    }

    /**
     * Check if the runner has paid.
     *
     * @return bool
     */
    public function hasPaid(): bool
    {
        return $this->status === 'PAID';
    }

    /**
     * Send notifications to the runner after payment.
     *
     * @return bool
     */
    public function sendPaymentNotifications(): bool
    {
        $success = true;

        // Send email notification
        if ($this->email && !$this->email_sent) {
            try {
                $downloadUrl = url('/registration/download/' . $this->reference);
                
                $data = [
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'gender' => $this->gender,
                    'age' => $this->age,
                    't_shirt_size' => $this->t_shirt_size,
                    'race_category' => $this->race_category,
                    'package' => $this->package,
                    'reference' => $this->reference,
                    'race_number' => $this->race_number,
                    'download_url' => $downloadUrl
                ];
                
                $email = new Emails();
                $email->subject = 'Marathon Registration Confirmation';
                $email->from = config('mail.from.address');
                $email->email = $this->email;
                $email->message = view('emails.runner-registration', $data)->render();
                $email->view = 'emails.runner-registration';
                $email->data = json_encode($data);
                $email->status = 'PENDING';
                $email->save();
                
                $this->markEmailSent();
            } catch (\Exception $e) {
                Log::error('Error sending email notification: ' . $e->getMessage());
                $success = false;
            }
        }

        // Send SMS notification
        if ($this->phone && !$this->sms_sent) {
            try {
                $smsText = "Dear {$this->name},\n"
                    . "Your marathon registration is confirmed!\n"
                    . "Race Number: {$this->race_number}\n"
                    . "Category: {$this->race_category}\n"
                    . "Reference: {$this->reference}\n"
                    . "Thank you for participating.";
                
                $sms = new SmsNotifications();
                $sms->message = $smsText;
                $sms->mobile = $this->phone;
                $sms->status = 'PENDING';
                $sms->sender = config('marathon.sms.sender_id', 'MARATHON');
                $sms->save();
                
                $this->markSmsSent();
            } catch (\Exception $e) {
                Log::error('Error sending SMS notification: ' . $e->getMessage());
                $success = false;
            }
        }

        // Send WhatsApp notification
        if ($this->phone && !$this->whatsapp_sent) {
            try {
                $waMessage = new WhatsAppNotifications();
                $waMessage->mobile = $this->phone;
                $waMessage->message = "Dear {$this->name},\n\n"
                    . "Your marathon registration is confirmed!\n\n"
                    . "Race Number: *{$this->race_number}*\n"
                    . "Category: {$this->race_category}\n"
                    . "Reference: {$this->reference}\n\n"
                    . "Please arrive at least 1 hour before your race start time and bring your race number.\n\n"
                    . "Thank you for participating!";
                $waMessage->status = 'PENDING';
                $waMessage->sender = config('marathon.whatsapp.sender_id', 'MARATHON');
                $waMessage->type = WhatsAppNotifications::MESSAGE_TYPE_TEXT;
                $waMessage->save();
                
                $this->markWhatsappSent();
            } catch (\Exception $e) {
                Log::error('Error sending WhatsApp notification: ' . $e->getMessage());
                $success = false;
            }
        }

        return $success;
    }

    /**
     * Check if the runner is pending payment.
     *
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->status === 'PENDING';
    }

    /**
     * Check if the runner has been cancelled.
     *
     * @return bool
     */
    public function isCancelled(): bool
    {
        return $this->status === 'CANCELLED';
    }

    /**
     * Mark the runner as cancelled.
     *
     * @return bool
     */
    public function markAsCancelled(): bool
    {
        $this->status = 'CANCELLED';
        return $this->save();
    }

    /**
     * Mark email as sent.
     *
     * @return bool
     */
    public function markEmailSent(): bool
    {
        $this->email_sent = true;
        return $this->save();
    }

    /**
     * Mark SMS as sent.
     *
     * @return bool
     */
    public function markSmsSent(): bool
    {
        $this->sms_sent = true;
        return $this->save();
    }

    /**
     * Mark WhatsApp as sent.
     *
     * @return bool
     */
    public function markWhatsappSent(): bool
    {
        $this->whatsapp_sent = true;
        return $this->save();
    }

    /**
     * Get the package name.
     *
     * @return string
     */
    public function getPackageNameAttribute(): string
    {
        return config("marathon.packages.{$this->package}.name") ?? $this->package;
    }

    /**
     * Get the race category description.
     *
     * @return string|null
     */
    public function getRaceCategoryDescriptionAttribute(): ?string
    {
        if ($this->race_category_key) {
            return config("marathon.categories.{$this->race_category_key}.description") ?? null;
        }
        
        return null;
    }

    /**
     * Get the race category start time.
     *
     * @return string|null
     */
    public function getRaceCategoryStartTimeAttribute(): ?string
    {
        if ($this->race_category_key) {
            return config("marathon.categories.{$this->race_category_key}.start_time") ?? null;
        }
        
        return null;
    }
}
