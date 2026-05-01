<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', fn($user) => $user->role === 'admin');

        Gate::define('manager-or-admin', fn($user) =>
        in_array($user->role, ['admin','manager'])
        );

        Gate::define('driver', fn($user) => $user->role === 'driver');
    }

    protected function redirectTo()
    {
        if(auth()->user()->role == User::ROLE_ADMIN) {
            return route('basses');
        }

        if(auth()->user()->role == User::ROLE_MANAGER) {
            return route('basses');
        }

        if(auth()->user()->role == User::ROLE_DRIVER) {
            return route('profile');
        }

        return '/';
    }
}
