<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        // defining admin-only gate middleware on boot (can(is-admin) is used in the middleware group)
        Gate::define('is-admin', function (User $user) {
            return $user->is_admin;
        });
    }
}
