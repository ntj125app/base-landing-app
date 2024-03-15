<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Laravel\Telescope\Telescope;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('patch:deploy', function () {
    /** Memory Leak mitigation */
    if (App::environment('local')) {
        Telescope::stopRecording();
    }

    /** PATCH DO HERE */
    $patchId = 'NULL';

    if ($this->confirm('Are you sure you want to deploy patch '.$patchId.'?')) {
        $this->info('Deploying patch '.$patchId.'...');

        /** Alert Log for patch deployment and clear application cache */
        $this->call('up');
        Log::alert('Console patch:deploy executed', ['patchId' => $patchId, 'appName' => config('app.name')]);
    } else {
        $this->info('Deploying patch '.$patchId.' aborted');
    }
})->purpose('Deploy patch');

$consoleFiles = glob(__DIR__.'/console/*.php');
foreach ($consoleFiles as $consoleFile) {
    require $consoleFile;
}
