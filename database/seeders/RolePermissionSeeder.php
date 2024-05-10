<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 役割を作成
        $role = Role::create(['name' => 'staff']);
        

        // 特定のユーザーを取得
        $user = User::find(1);

        // ユーザーに役割を割り当て
        $user->assignRole('staff');
    }
}
