<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transactions extends Model
{

    public function getProviderReference()
    {
        return $this->provider_external_reference;
    }

    public function paymentProvider()
    {
        return $this->belongsTo(PaymentProviders::class, 'payment_provider_id');
    }

    public function merchant()
    {
        return $this->hasOne(Merchants::class, 'id', 'merchant_id');
    }

    public function logs()
    {
        return $this->hasMany(PerformanceLogs::class, 'reference_1', 'reference');
    }
}
