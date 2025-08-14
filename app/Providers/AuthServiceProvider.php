<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('view-sales', fn(User $u) => $u->can('view sales'));
        Gate::define('view-reporting', fn(User $u) => $u->can('view reporting'));
        Gate::define('manage-users', fn(User $u) => $u->can('manage users'));
    }
}


