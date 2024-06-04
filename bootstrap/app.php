<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Sentry\Laravel\Integration;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/app/healthcheck',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '192.168.0.0/16');
        $middleware->trustProxies(headers: Request::HEADER_X_FORWARDED_FOR);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        if (app()->bound('sentry')) {
            Integration::handles($exceptions);
        }
    })->create();
