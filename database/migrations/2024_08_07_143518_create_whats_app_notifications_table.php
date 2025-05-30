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
        Schema::create('whats_app_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('mobile');
            $table->text('message');
            $table->string('status')->default('PENDING');
            $table->string('sender');
            $table->timestamp('sent_at')->nullable();
            $table->string('type')->nullable();
            $table->string('template')->nullable();
            $table->json('template_data')->nullable();
            $table->integer('attempts')->default(0);
            $table->text('response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whats_app_notifications');
    }
};
