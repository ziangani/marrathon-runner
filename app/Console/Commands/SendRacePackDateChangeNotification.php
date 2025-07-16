<?php

namespace App\Console\Commands;

use App\Models\Runner;
use App\Models\SmsNotifications;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendRacePackDateChangeNotification extends Command
{
    protected $signature = 'send:racepack-date-change';
    protected $description = 'Send SMS notification to paid runners about race pack collection date change';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $paidRunners = Runner::where('status', 'PAID')->get();
            $totalCount = $paidRunners->count();

            $this->info("Found {$totalCount} paid runners to notify about date change.");

            if ($totalCount === 0) {
                $this->warn('No paid runners found. Exiting.');
                return;
            }

            $successCount = 0;
            $skippedCount = 0;

            foreach ($paidRunners as $runner) {
                if (!$runner->phone) {
                    $this->warn("Skipping runner {$runner->name} - no phone number");
                    $skippedCount++;
                    continue;
                }

                $message = "Dear Participant,\n"
                    . "IMPORTANT UPDATE: The LuWSI Run for Water Security 2025 race pack collection date has been CHANGED.\n"
                    . "NEW DATE: Friday, 18th July 2025 (previously Thursday, 17th July 2025)\n"
                    . "Time remains the same: 08:00hrs - 17:00hrs\n"
                    . "Venue remains the same:\n"
                    . "NWASCO House\n"
                    . "No. 164 Mulombwa Close\n"
                    . "Fairview, Lusaka\n"
                    . "We sincerely apologize for any inconvenience this change may have caused.\n"
                    . "Thank you for your understanding.\n"
                    . "Warm regards,\n"
                    . "LuWSI Team";

                // Check message length
                $messageLength = strlen($message);
                $this->info("Message length: {$messageLength} chars");

                $sms = new SmsNotifications();
                $sms->message = $message;
                $sms->mobile = $runner->phone;
                $sms->status = 'PENDING';
                $sms->sender = config('marathon.sms.sender_id', 'TechPay');
                $sms->save();

                $this->info("Date change notification queued for: {$runner->name} ({$runner->phone})");
                $successCount++;
            }

            // Summary with clear totals
            $this->line('');
            $this->info('=== NOTIFICATION SUMMARY ===');
            $this->info("Total paid runners found: {$totalCount}");
            $this->info("Notifications successfully queued: {$successCount}");
            $this->info("Skipped (no phone number): {$skippedCount}");
            $this->info('================================');
            
            if ($successCount > 0) {
                $this->info('All date change notifications have been queued successfully.');
                $this->info('Run "php artisan sendsms" to process the SMS queue and send messages.');
            }

        } catch (\Exception $ex) {
            $this->error('Error sending date change notifications: ' . $ex->getMessage());
            Log::error('Error sending race pack date change notifications: ' . $ex->getMessage() . ' File: ' . $ex->getFile() . ' Line: ' . $ex->getLine());
        }
    }
}