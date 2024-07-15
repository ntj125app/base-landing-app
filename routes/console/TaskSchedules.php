<?php

use Illuminate\Support\Facades\Schedule;

/** Packages Cron */
Schedule::command('model:prune')->everyMinute();
Schedule::command('queue:prune-failed')->hourly();
Schedule::command('queue:prune-batches')->hourly();
Schedule::command('queue:flush')->hourly();

if (class_exists(\Laravel\Horizon\HorizonServiceProvider::class)) {
    Schedule::command('horizon:snapshot')->everyFiveMinutes();
}

if (class_exists(\Laravel\Passport\PassportServiceProvider::class)) {
    Schedule::command('passport:purge')->hourly();
}

if (class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
    Schedule::command('telescope:prune')->hourly();
}

if (class_exists(\Laravel\Pulse\PulseServiceProvider::class)) {
    Schedule::command('pulse:check')->dailyAt('00:00')->withoutOverlapping();
    Schedule::command('pulse:work')->everyFifteenMinutes()->withoutOverlapping();
    Schedule::command('pulse:clear', ['--type=cpu,memory,system'])->everyFifteenMinutes();
}

if (config('cache.default') === 'redis') {
    Schedule::command('cache:prune-stale-tags')->hourly();
}

/** Custom Jobs Cron */
