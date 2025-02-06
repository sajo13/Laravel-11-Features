<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Trim all strings except 'secret' input fields
        TrimStrings::except(['secret']);

        // Redirect authenticated users to the dashboard route
        RedirectIfAuthenticated::redirectUsing(fn ($request) => route('dashboard'));

        Request::macro('identifier', function () {
            return once(fn() => Str::uuid());
        });
    }
}
