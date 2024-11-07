<?php

use App\Interfaces\InterfaceClass;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Laravel\Pennant\Feature;

Artisan::command('system:refresh', function () {
    $this->call('cache:clear');
    if (config('pennant.default') === 'database') {
        Feature::flushCache();
        Feature::purge();
    }

    $this->call('view:clear');
    $this->info('Cache cleared');

    $this->info('System refreshed');

    Log::alert('Console system:refresh executed', ['appName' => config('app.name')]);
})->purpose('Refresh system');

Artisan::command('system:start', function () {

    $this->call('storage:link');

    $this->info('System startup scripts executed');

    Log::alert('Console system:start executed', ['appName' => config('app.name'), 'appVersion' => InterfaceClass::readApplicationVersion()]);
})->purpose('Start system');
