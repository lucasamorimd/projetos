<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('admin', function ($user) {
            return $user->tipo_perfil === 'administrador';
        });
        Gate::define('cadastrar-usuario', function ($user) {
            return $user->email === 'lucas.ad@hotmail.com';
        });
        Gate::define('admin-func', function ($user) {
            return $user->tipo_perfil === 'administrador' || $user->tipo_perfil === 'funcionario';
        });
    }
}
