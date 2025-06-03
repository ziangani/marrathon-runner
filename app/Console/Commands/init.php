<?php

namespace App\Console\Commands;

use App\Models\PaymentProviders;
use App\Models\Transactions;
use Illuminate\Console\Command;

class init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Initializing payment providers...');
        if (!PaymentProviders::where('merchant_code', 'TECHPAY_LWSI')->exists()) {
            $paymentProvider = new PaymentProviders();
            $paymentProvider->name = 'TechPay - LWSI';
            $paymentProvider->merchant_code = 'TECHPAY_LWSI';
            $paymentProvider->api_url = 'https://new.techpay.co.zm/techpay/public';
            $paymentProvider->api_secret = 'pk_live_uK4cZIH5ApCXF8RMDSkWCOlf';
            $paymentProvider->api_key = 'b0YFVdPDJktlWmq6JRbLGA2D8lrdxsfm';
            $paymentProvider->save();
        }

        $this->info('Initializing users...');
        if (!\App\Models\User::where('email', 'luwsisecretariat@gmail.com')->exists()) {
            $user = new \App\Models\User();
            $user->name = 'Lusaka Water Security Initiative';
            $user->email = 'luwsisecretariat@gmail.com ';
            $user->password = bcrypt('Password123$'); // Use a secure password
            $user->save();
            $this->info('User created: ' . $user->email);
        } else {
            $this->info('User already exists');
        }
    }
}
