<?php

use App\Console\Commands\updateTransactionStatus;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;



Schedule::command(updateTransactionStatus::class)->everyTenSeconds()->runInBackground()->withoutOverlapping();

