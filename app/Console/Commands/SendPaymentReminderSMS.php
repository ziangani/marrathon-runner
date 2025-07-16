<?php

namespace App\Console\Commands;

use App\Models\Runner;
use App\Models\SmsNotifications;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendPaymentReminderSMS extends Command
{
    protected $signature = 'send:payment-reminder-sms';
    protected $description = 'Send payment reminder SMS to pending runners';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $pendingRunners = Runner::where('status', 'PENDING')->get();
            $this->info(count($pendingRunners) . ' pending runners found.');

            foreach ($pendingRunners as $runner) {
                if (!$runner->phone) {
                    $this->warn("Skipping runner {$runner->name} - no phone number");
                    continue;
                }

                $smsText = "Dear Participant, Payment for LuWSI Run (Sat 19 July 2025) is pending. Pay by Thurs 17 July to secure your spot & race pack. Complete payment: https://luwsi.techpay.co.zm/ - LuWSI Team";

                // Create SMS notification record
                $sms = new SmsNotifications();
                $sms->message = $smsText;
                $sms->mobile = $runner->phone;
                $sms->status = 'PENDING';
                $sms->sender = config('marathon.sms.sender_id', 'LuWSI');
                $sms->save();

                $this->info("Payment reminder SMS queued for {$runner->name} ({$runner->phone})");
            }

            $this->info('All payment reminder SMS notifications have been queued.');
            $this->info('Run "php artisan sendsms" to process the SMS queue.');

        } catch (\Exception $ex) {
            $this->error('Something went wrong: ' . $ex->getMessage() . ' ' . $ex->getFile());
            Log::error('Error queuing payment reminder SMS: ' . $ex->getMessage());
        }
    }
}