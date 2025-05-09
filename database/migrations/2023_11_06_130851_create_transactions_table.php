<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->float('amount', 15, 2);
            $table->string('status')->default('PENDING');
            $table->integer('payment_provider_id');
            $table->string('merchant_code');
            $table->string('reference');
            $table->integer('payer_kyc_id');
            $table->string('provider_external_reference')->nullable();
            $table->string('provider_status_description')->nullable();
            $table->string('provider_payment_reference')->nullable();
            $table->dateTime('provider_payment_confirmation_date')->nullable();
            $table->date('provider_payment_date')->nullable();
            $table->string('payment_channel')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('settlement_status')->default('PENDING');
            $table->foreign('payment_provider_id')->references('id')->on('payment_providers');
            $table->foreign('payer_kyc_id')->references('id')->on('payer_kycs');
            $table->boolean("user_notified")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
