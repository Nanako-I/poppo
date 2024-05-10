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
    Gate::define('role', function($user) {
    // ユーザーが持つ役割を取得します
    $roles = $user->roles;
    
    // 役割の中に"staff"があるかどうかをチェックします
    return $roles->contains('name', 'staff');
});
    // Gate::define('role', function(User $user, Role $role) {
        // return $user->id==$role->user_id;
    
    // Gate::define('role',function($user){

        //   return $user->role == 'staff';
        // $roles = $user->roles;
        
        // return $roles->contains('name', 'staff');
        
//     Gate::define('role', function($user) {
//     // ユーザーのIDを使用して中間テーブルから行を取得します
//     $userRole = User::where('id', $user->id)->where('role_id', 'staff')->first();
    
//     // 中間テーブルの行が見つかった場合は true を返します
//     return $userRole !== null;
// // }
// });
    
}
}
