<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        // Gate::define('alluser', function (User $user) {
        //     $allowedRoles = ['user', 'TU', 'admin']; // Tambahkan role-role yang diizinkan disini
        //     return in_array($user->level, $allowedRoles);
        // });

        Gate::define('login', function (User $user) {
            return in_array($user->level, ['user', 'TU']);
        });

        Gate::define('admin', function (User $user) {
            return $user->level === 'admin';
        });
    }
}
