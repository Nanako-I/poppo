<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Models\Role;

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

        Gate::define('role', function ($user) {
            // ユーザーが持つ役割を取得します
            $roles = $user->roles;

            // 役割の中に"staff"があるかどうかをチェックします
            return $roles->contains('name', 'staff');
        });

        // SuperAdministratorの場合、全ての権限無視して実行できる
        // 上記既存コードと当たるかもしれないので一旦コメントアウト
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        // Gate::before(function ($user, $ability) {
        //     return $user->hasRole(Role::SuperAdministrator) ? true : null;
        // });
    }
}
