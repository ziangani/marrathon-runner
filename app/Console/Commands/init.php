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

//            $paymentProvider = new PaymentProviders();
//            $paymentProvider->name = 'TechPay - Prod';
//            $paymentProvider->merchant_code = 'TECHPAY_PROD';
//            $paymentProvider->api_url = 'https://pay.techpay.co.zm/techpay/public';
//            $paymentProvider->api_key = 'e601a9ff2d087fc571b0162826c1396c5877de3a6d6b971da435f8eeadf53d38';
//            $paymentProvider->api_secret = 'c274315534d13564bf604c23498935b4';
//            $paymentProvider->save();
        }
    }
}
