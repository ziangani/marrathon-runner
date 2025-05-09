<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentProviders extends Model
{


    public static function getDefault() : self
    {
        return self::where('merchant_code', 'TECHPAY_PROD')
            ->first();
    }
}
