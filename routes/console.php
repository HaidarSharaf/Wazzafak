<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('jobs:notify-pending')->everyThirtyMinutes()->runInBackground();
Schedule::command('analytics:send-daily')->dailyAt('09:00')->runInBackground();
