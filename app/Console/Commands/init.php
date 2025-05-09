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
        if ($provider = PaymentProviders::where('merchant_code', 'TECHPAY_NEW')->exists()) {
            $provider = PaymentProviders::where('merchant_code', 'TECHPAY_NEW')->first();
            Transactions::where('payment_provider_id', $provider->id)->delete();
            PaymentProviders::where('merchant_code', 'TECHPAY_NEW')->delete();
            $paymentProvider = new PaymentProviders();
            $paymentProvider->name = 'TechPay - NEW';
            $paymentProvider->merchant_code = 'TECHPAY_NEW';
            $paymentProvider->api_url = 'http://localhost:8001/techpay/public';
            $paymentProvider->api_secret = 'pk_live_8GMA6YDuOutS9zYDyMV6FWWI';
            $paymentProvider->api_key = 'YzyvRvVc85D8fr8YzChPWzlUD2wzISiL';
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
