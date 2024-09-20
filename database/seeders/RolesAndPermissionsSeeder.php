<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\RoleType as RoleEnums;
use App\Enums\PermissionType;
use App\Models\Facility;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Models\Person;
use App\Models\MedicalCareNeed;


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
            if (!Permission::where('name', $permission)->where('guard_name', 'web')->exists()) {
                Permission::create(['name' => $permission, 'guard_name' => 'web']);
            }
        }

        // create roles and assign created permissions

        $rolesAndPermissions = [
            RoleEnums::SuperAdministrator => Permission::all(),
            RoleEnums::FacilityStaffAdministrator => Permission::all(),
            RoleEnums::FacilityStaffUser => [
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
            ],
            RoleEnums::FacilityStaffReader => [
                PermissionType::ReadFacility,
                PermissionType::ReadFacilityStaff,
                PermissionType::ReadFacilityClient,
                PermissionType::ReadClientFamily,
            ],
            RoleEnums::ClientFamilyUser => [
                PermissionType::EditFacilityClient,
                PermissionType::ReadFacilityClient,
                PermissionType::EditClientFamily,
                PermissionType::ReadClientFamily,
            ],
            RoleEnums::ClientFamilyReader => [
                PermissionType::ReadFacilityClient,
                PermissionType::ReadClientFamily,
            ],
        ];
        
        foreach ($rolesAndPermissions as $roleName => $permissions) {
            if (!Role::where('name', $roleName)->where('guard_name', 'web')->exists()) {
                $role = Role::create(['name' => $roleName, 'guard_name' => 'web']);
                $role->givePermissionTo($permissions);
            }
        }


        // 施設管理者権限のユーザーを作成
        if (!User::where('email', 'admin_staff@boocare.co.jp')->exists()) {
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
        $medicalCareMajority = MedicalCareNeed::where('name', 'medical_care_majority')->first();

        // もし存在するなら、テスト施設にmedical_care_majorityを紐づけ
        // if ($medicalCareMajority && $facility) {
            $facility->medicalCareNeeds()->attach($medicalCareMajority->id);
        // }

        // 家族編集権限のユーザーを作成
        if (!User::where('email', 'admin_family@boocare.co.jp')->exists()) {
        $familyAdminUser = new User();
        $familyAdminUser->name = '家族花子';
        $facilityAdminUser->custom_id = '1223VbfH';
        $familyAdminUser->email = 'admin_family@boocare.co.jp';
        $familyAdminUser->password = \Hash::make('Password1234');
        $familyAdminUser->save();
        $familyAdminUser->assignRole(RoleEnums::ClientFamilyUser);
        
        
        // 家族花子の子ども（施設利用者）を作成
        if (!Person::where('person_name', '利用者二郎')->exists()) {
        $person = new Person();
        $person->person_name = '利用者二郎';
        $person->date_of_birth = '20000630';
        $person->gender = '男';
        $person->jukyuusha_number = '1234567890';
        $person->save();
       
        
        // 上記で作成したテスト施設と利用者を紐づけ
        $person->people_facilities()->attach($facility->id);
        
        // 家族花子と利用者二郎を紐づけ
        $familyAdminUser->people_family()->attach($person->id);
        }
        }
        }
    }
}
