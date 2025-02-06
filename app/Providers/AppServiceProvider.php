<?php

namespace App\Providers;

use App\Services\ApiRequestService;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the ApiRequestService
        $this->app->singleton(ApiRequestService::class, function ($app) {
            return new ApiRequestService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            if (auth()->user()->isOnePaidPlan()) {
                return Limit::perMinute(1000)->by(auth()->id());
            }

            return Limit::perMinute(10)->by(auth()->id());
        });
    }
}
