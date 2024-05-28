<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\RoleType as RoleEnums;
use App\Enums\PermissionType;
use App\Models\Facility;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        foreach (PermissionType::getValues() as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // create roles and assign created permissions

        Role::create(['name' => RoleEnums::SuperAdministrator, 'guard_name' => 'web'])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => RoleEnums::FacilityStaffAdministrator, 'guard_name' => 'web'])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => RoleEnums::FacilityStaffUser, 'guard_name' => 'web'])
            ->givePermissionTo([
                PermissionType::ReadFacility,
                PermissionType::ReadFacilityStaff,
                PermissionType::CreateFacilityClient,
                PermissionType::EditFacilityClient,
                PermissionType::DeleteFacilityClient,
                PermissionType::ReadFacilityClient,
                PermissionType::CreateClientFamily,
                PermissionType::EditClientFamily,
                PermissionType::DeleteClientFamily,
                PermissionType::ReadClientFamily,
            ]);

        Role::create(['name' => RoleEnums::FacilityStaffReader, 'guard_name' => 'web'])
            ->givePermissionTo([
                PermissionType::ReadFacility,
                PermissionType::ReadFacilityStaff,
                PermissionType::ReadFacilityClient,
                PermissionType::ReadClientFamily,
            ]);

        Role::create(['name' => RoleEnums::ClientFamilyUser, 'guard_name' => 'web'])
            ->givePermissionTo([
                PermissionType::EditFacilityClient,
                PermissionType::ReadFacilityClient,
                PermissionType::EditClientFamily,
                PermissionType::ReadClientFamily,
            ]);

        Role::create(['name' => RoleEnums::ClientFamilyReader, 'guard_name' => 'web'])
            ->givePermissionTo([
                PermissionType::ReadFacilityClient,
                PermissionType::ReadClientFamily,
            ]);

        // 施設管理者権限のユーザーを作成
        $facilityAdminUser = new User();
        $facilityAdminUser->name = '施設太郎';
        $facilityAdminUser->custom_id = 'kOERJHRU';
        $facilityAdminUser->email = 'admin_staff@boocare.co.jp';
        $facilityAdminUser->password = \Hash::make('Password1234');
        $facilityAdminUser->save();
        $facilityAdminUser->assignRole(RoleEnums::FacilityStaffAdministrator);

        // 施設を作成・ユーザーと紐づけ
        $facility = new Facility();
        $facility->facility_name = 'テスト施設';
        $facility->bikou = 'テスト施設の備考';
        $facility->save();
        $facility->facility_staffs()->attach($facilityAdminUser->id);

        // 家族編集権限のユーザーを作成
        $familyAdminUser = new User();
        $familyAdminUser->name = '家族花子';
        $facilityAdminUser->custom_id = '1223VbfH';
        $familyAdminUser->email = 'admin_family@boocare.co.jp';
        $familyAdminUser->password = \Hash::make('Password1234');
        $familyAdminUser->save();
        $familyAdminUser->assignRole(RoleEnums::ClientFamilyUser);
    }
}
