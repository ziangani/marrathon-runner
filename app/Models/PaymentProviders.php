<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentProviders extends Model
{


    public static function getDefault() : self
    {
        throw new \Exception('Operation not supported');
    }
}
