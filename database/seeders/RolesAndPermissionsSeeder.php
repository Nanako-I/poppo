<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\RoleType as RoleEnums;
use App\Enums\PermissionType;
use App\Models\Role;
use App\Models\Permission;

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
    }
}
