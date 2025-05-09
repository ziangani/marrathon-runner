<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('status')->default('ACTIVE');
            $table->string('merchant_code')->unique();
            $table->string('api_key')->nullable();
            $table->string('api_secret')->nullable();
            $table->string('api_url')->nullable();
            $table->string('api_token')->nullable();
            $table->string('callback_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_providers');
    }
}
