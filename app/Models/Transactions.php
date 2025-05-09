<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transactions extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference',
        'amount',
        'status',
        'payment_provider_id',
        'merchant_code',
        'payer_kyc_id',
        'provider_external_reference',
        'provider_status_description',
        'provider_payment_reference',
        'provider_payment_confirmation_date',
        'provider_payment_date',
        'payment_channel',
        'payment_type',
        'settlement_status',
        'user_notified',
        'provider_reference',
        'provider_response',
        'paid_at',
    ];

    public function getProviderReference()
    {
        return $this->provider_external_reference;
    }

    public function paymentProvider()
    {
        return $this->belongsTo(PaymentProviders::class, 'payment_provider_id');
    }
}
