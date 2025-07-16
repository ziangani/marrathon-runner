<?php

namespace App\Console\Commands;

use App\Models\Runner;
use App\Models\SmsNotifications;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendPendingPaymentReminder extends Command
{
    protected $signature = 'send:pending-reminder';
    protected $description = 'Send payment reminder SMS to runners with pending payments';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $runners = Runner::where('status', 'PENDING')->get();

            $this->info(count($runners) . ' pending payment runners found.');

            foreach ($runners as $runner) {
                $message = "Dear Participant,\n"
                    . "This is a friendly reminder that your payment for the LuWSI Run for Water Security 2025 is still pending.\n"
                    . "Event Date: Saturday, 19th July 2025\n"
                    . "Payment Deadline: Thursday, 17th July 2025\n"
                    . "Please complete your payment by the deadline to secure your spot and race pack.\n"
                    . "Payment Link: https://luwsi.techpay.co.zm/\n"
                    . "For any assistance, please contact our support team.\n"
                    . "Thank you for your participation in this important event.\n"
                    . "Warm regards,\n"
                    . "LuWSI Team";

                $sms = new SmsNotifications();
                $sms->message = $message;
                $sms->mobile = $runner->phone;
                $sms->status = 'PENDING';
                $sms->sender = config('marathon.sms.sender_id', 'TechPay');
                $sms->save();

                $this->info('Payment reminder queued for runner: ' . $runner->name);
            }
        } catch (\Exception $ex) {
            $this->error('Error sending payment reminders: ' . $ex->getMessage());
            Log::error('Error sending pending payment reminders: ' . $ex->getMessage());
        }
    }
}
