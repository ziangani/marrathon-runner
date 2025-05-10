<?php

use App\Console\Commands\sendEmail;
use App\Console\Commands\SendRunnerNotifications;
use App\Console\Commands\updateTransactionStatus;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;



Schedule::command(updateTransactionStatus::class)->everyTenSeconds()->runInBackground()->withoutOverlapping();

// Schedule runner notifications to be sent every minute
// This will process notifications for runners who have paid but haven't been notified yet
Schedule::command(SendRunnerNotifications::class)->everyMinute()->runInBackground()->withoutOverlapping();
Schedule::command(SendEmail::class)->everyMinute()->runInBackground()->withoutOverlapping();

