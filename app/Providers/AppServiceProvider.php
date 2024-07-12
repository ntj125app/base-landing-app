<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /** Laravel strict exception */
        Model::preventSilentlyDiscardingAttributes(! $this->app->environment('production'));

        /** Registering Rate Limits */
        RateLimiter::for('api', function (Request $request) {
            return Limit::perSecond(300)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('api-min', function (Request $request) {
            return Limit::perSecond(1)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('api-secure', function (Request $request) {
            return Limit::perMinute(10)->by($request->user()?->id ?: $request->ip());
        });
    }
}
