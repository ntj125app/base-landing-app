<?php

use Illuminate\Support\Facades\Schedule;

/** Packages Cron */
Schedule::command('model:prune')->everyMinute()->withoutOverlapping();
Schedule::command('queue:prune-failed')->hourly()->withoutOverlapping();
Schedule::command('queue:prune-batches')->hourly()->withoutOverlapping();
Schedule::command('queue:flush')->hourly()->withoutOverlapping();

if (config('cache.default') === 'redis') {
    Schedule::command('cache:prune-stale-tags')->hourly()->withoutOverlapping();
}

if (app()->environment('local')) {
    Schedule::command('telescope:prune')->hourly()->withoutOverlapping();
}

/** Custom Jobs Cron */
