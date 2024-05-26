<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Facility;
use App\Models\Person;
use App\Models\Role;
use App\Models\Permission;

use Spatie\Permission\Models\Role as SpatieRole;
use App\Enums\RoleType;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Http\Request;
use App\Enums\PermissionType;
use App\Enums\RoleType as RoleEnums;
use App\Enums\Role as RoleEnum;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // ログインしているユーザーの情報↓
        $user = auth()->user();

        $user->facility_staffs()->first();

        // facility_staffsメソッドからuserの情報をゲットする↓
        $facilities = $user->facility_staffs()->get();

        // dd($facilities);
        $roles = $user->user_roles()->get(); // これでロールが取得できる
        //   dd($roles);

        $rolename = $user->getRoleNames(); // ロールの名前を取得


        // $isSuperAdmin = $user->hasRole(RoleType::SuperAdministrator);

        // dd($rolename);
        
        $isSuperAdmin = $user->hasRole(RoleType::FacilityStaffAdministrator);
// dd($isSuperAdmin);

        // ロールのIDを取得する場合
        $roleIds = $user->roles->pluck('id');

        // dd(compact('roles', 'roleIds'));
        // $roles = $user->getAllPermissions();
        // $roles = $user->getRoleNames();
        // $roles =$user->hasPermissionTo('edit facility staff');
        // ユーザーのロールとパーミッションをデバッグ
        // $roles = $user->getRoleNames();
        // $permissions = $user->getAllPermissions()->pluck('name');
        // dd(compact('roles', 'permissions'));


        $firstFacility = $facilities->first();
        if ($firstFacility) {
            $people = $firstFacility->people_facilities()->get();
        } else {
            $people = []; // まだpeople（利用者が登録されていない時もエラーが出ないようにする）
        }

        return view('people', compact('people'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peopleregister');
    }


    public function store(Request $request)
    {
        $storeData = $request->validate([
            'person_name' => 'required|max:255',
            'date_of_birth' => 'required|max:255',
            'jukyuusha_number' => 'required|digits:10',
        ]);

        $directory = 'public/sample';
        $filename = null;
        $filepath = null;

        if ($request->hasFile('filename')) {
            $request->validate([
                'filename' => 'image|max:2048',
            ]);
            $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
            $filename = $request->file('filename')->getClientOriginalName();
            $request->file('filename')->storeAs($directory, $filename);
            $filepath = $directory . '/' . $filename;
        }

        $newpeople = Person::create([
            'person_name' => $request->person_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'jukyuusha_number' => $request->jukyuusha_number,
            'filename' => $filename,
            'path' => $filepath,

        ]);

        $user = auth()->user();

        // facility_staffsメソッドからuserの情報をゲットする↓
        $facilities = $user->facility_staffs()->get();
        $firstFacility = $facilities->first();

        // 現在ログインしているユーザーが属する施設にpeople（利用者）を紐づける↓
        // syncWithoutDetaching＝完全重複以外は、重複OK
        $newpeople->people_facilities()->syncWithoutDetaching($firstFacility->id);

        if ($firstFacility) {
            $people = $firstFacility->people_facilities()->get();
        } else {
            $people = []; // まだpeople（利用者が登録されていない時もエラーが出ないようにする）
        }

        // 二重送信防止
        $request->session()->regenerateToken();
        return view('people', compact('people'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return view('temperature.' . $person->id . '.edit'); //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */

    // 更新画面の表示↓
    public function edit($id)
    {
        $person = Person::find($id);
        return view('peopleedit', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */

    // 体温登録のルート↓
    public function showtemperature(Person $person)
    {
        $people = Person::all();
        // ('people')に$peopleが代入される
        return view('temperaturelist', compact('people'));
    }

    // 食事
    // 登録のルート↓
    public function showfood(Person $person)
    {
        $people = Person::all();
        // ('people')に$peopleが代入される
        return view('foodlist', compact('people'));
    }
    //  フォームから送られてきたデータ↓
    public function update(Request $request, Person $person)
    {
        $storeData = $request->validate([
            //  requireは必須項目　nullableは書かなくてもいい
            // 'person_name' => 'required|max:255',
            // 'date_of_birth' => 'required|max:255',
            // 'age' => 'required|max:255',
        ]);

        $person->update($updateData);
        // トップページに返す↓
        return redirect('/people');
    }



    public function uploadForm()
    {
        // return view('people');変更↓
        return view('peopleregister');
    }





    public function __invoke()
    {
        return view('person');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {

        $person->delete();
        return redirect('/people');
    }
}
