<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        //
        Gate::define("isPlayer", function ($user) {
            if ($user->role == "Player") {
                return Response::allow();
            } else {
                return Response::deny("Hanya untuk Player");
            }
        });

        Gate::define("isAdminDowngrade", function ($user) {
            if ($user->role == "AdminDowngrade") {
                return Response::allow();
            } else {
                return Response::deny("Hanya untuk Penjual Downgrade");
            }
        });

        Gate::define("isAdminBahan", function ($user) {
            if ($user->role == "AdminBahan") {
                return Response::allow();
            } else {
                return Response::deny("Hanya untuk Penjual Bahan");
            }
        });

        Gate::define("isTinkerer", function ($user) {
            if ($user->role == "Tinkerer") {
                return Response::allow();
            } else {
                return Response::deny("Hanya untuk Tinkerer");
            }
        });
    }
}
