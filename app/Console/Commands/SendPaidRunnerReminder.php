<?php

namespace App\Console\Commands;

use App\Models\Runner;
use App\Models\SmsNotifications;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendPaidRunnerReminder extends Command
{
    protected $signature = 'send:paid-reminder';
    protected $description = 'Send SMS reminders to paid runners about the upcoming event';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $runners = Runner::where('status', 'PAID')->get();

            $this->info(count($runners) . ' paid runners found.');

            foreach ($runners as $runner) {
                $message = "Dear Participant,\n"
                    . "This is a friendly reminder that the LuWSI Run for Water Security 2025 will take place this Saturday.\n"
                    . "You may collect your race pack on Thursday, 17th July 2025, between 08:00hrs and 17:00hrs at:\n"
                    . "NWASCO House\n"
                    . "No. 164 Mulombwa Close\n"
                    . "Fairview, Lusaka\n"
                    . "We look forward to your participation and thank you for being part of this important event.\n"
                    . "Warm regards,\n"
                    . "LuWSI Team";

                $sms = new SmsNotifications();
                $sms->message = $message;
                $sms->mobile = $runner->phone;
                $sms->status = 'PENDING';
                $sms->sender = config('marathon.sms.sender_id', 'TechPay');
                $sms->save();

                $runner->markSmsSent();
                $this->info('Reminder queued for runner: ' . $runner->name);
            }
        } catch (\Exception $ex) {
            $this->error('Error sending reminders: ' . $ex->getMessage());
            Log::error('Error sending paid runner reminders: ' . $ex->getMessage());
        }
    }
}
