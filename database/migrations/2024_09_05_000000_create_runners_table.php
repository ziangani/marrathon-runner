<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('runners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('age');
            $table->string('gender');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('t_shirt_size');
            $table->string('race_category');
            $table->string('race_category_key')->nullable();
            $table->string('health_condition');
            $table->text('health_condition_specify')->nullable();
            $table->string('how_did_you_hear_about_us');
            $table->string('exhibiting');
            $table->string('package');
            $table->decimal('package_amount', 10, 2);
            $table->string('reference')->unique();
            $table->string('race_number')->nullable();
            $table->string('status')->default('PENDING'); // PENDING, PAID, CANCELLED
            $table->string('transaction_id')->nullable();
            $table->string('payment_provider')->nullable();
            $table->string('payment_reference')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->boolean('email_sent')->default(false);
            $table->boolean('sms_sent')->default(false);
            $table->boolean('whatsapp_sent')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('runners');
    }
};
