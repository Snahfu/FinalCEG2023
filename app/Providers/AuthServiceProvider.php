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
                return Response::deny("Hanya untuk Pos Penjual Downgrade");
            }
        });

        Gate::define("isAdminBahan", function ($user) {
            if ($user->role == "AdminBahan") {
                return Response::allow();
            } else {
                return Response::deny("Hanya untuk Pos Penjual Bahan");
            }
        });

        Gate::define("isDnC", function ($user) {
            if ($user->role == "DnC") {
                return Response::allow();
            } else {
                return Response::deny("Hanya untuk Pos DnC");
            }
        });

        Gate::define("isIngredient", function ($user) {
            if ($user->role == "Ingredient") {
                return Response::allow();
            } else {
                return Response::deny("Hanya untuk Pos Ingredient");
            }
        });

        Gate::define("isTool", function ($user) {
            if ($user->role == "Tool") {
                return Response::allow();
            } else {
                return Response::deny("Hanya untuk Pos Tool");
            }
        });

        Gate::define("isHint", function ($user) {
            if ($user->role == "AdminHint") {
                return Response::allow();
            } else {
                return Response::deny("Hanya untuk Pos Hint");
            }
        });
    }
}
