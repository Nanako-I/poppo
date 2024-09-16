<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Facility;
use App\Models\Person;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Chat;


use Spatie\Permission\Models\Role as SpatieRole;
use App\Enums\RoleType;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
    
     public function index(User $user)
     {
         // ログインしているユーザーの情報↓
        $user = auth()->user();

        $user->facility_staffs()->first();

        // facility_staffsメソッドからuserの情報をゲットする↓
        $facilities = $user->facility_staffs()->get();

        $roles = $user->user_roles()->get(); // これでロールが取得できる

        $rolename = $user->getRoleNames(); // ロールの名前を取得
        $isSuperAdmin = $user->hasRole(RoleType::FacilityStaffAdministrator);

        // ロールのIDを取得する場合
        $roleIds = $user->roles->pluck('id');

        $firstFacility = $facilities->first();
        if ($firstFacility) {
            $people = $firstFacility->people_facilities()->get();
        } else {
            $people = []; // まだpeople（利用者が登録されていない時もエラーが出ないようにする）
        }

        foreach ($people as $person) {
            $unreadMessages = Chat::where('people_id', $person->id)
                                  ->where('is_read', false)
                                  ->where('user_identifier', '!=', $user->id)
                                  ->exists();
        
            $person->unreadMessages = $unreadMessages;
            \Log::info("Person {$person->id} unread messages: " . ($unreadMessages ? 'true' : 'false'));
        }

        $selectedItems = [];
        
        // Loop through each person and decode their selected items
        foreach ($people as $person) {
            $selectedItems[$person->id] = json_decode($person->selected_items, true) ?? [];
        }
    
        return view('people', compact('people', 'selectedItems'));
    }
     
  

    public function show(User $user)
    {

        \Log::info('PersonController index method started.');
        \Log::info('This is a test log.');


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


        $isSuperAdmin = $user->hasRole(RoleType::FacilityStaffAdministrator);
        // dd($isSuperAdmin);

        // ロールのIDを取得する場合
        $roleIds = $user->roles->pluck('id');

        $firstFacility = $facilities->first();
        if ($firstFacility) {
            $people = $firstFacility->people_facilities()->get();
        } else {
            $people = []; // まだpeople（利用者が登録されていない時もエラーが出ないようにする）
        }

        foreach ($people as $person) {
            $unreadMessages = Chat::where('people_id', $person->id)
                                  ->where('is_read', false)
                                  ->where('user_identifier', '!=', $user->id)
                                  ->exists();
        
            $person->unreadMessages = $unreadMessages;
            \Log::info("Person {$person->id} unread messages: " . ($unreadMessages ? 'true' : 'false'));
        }

        $selectedItems = [];
        
        // Loop through each person and decode their selected items
        foreach ($people as $person) {
            $selectedItems[$person->id] = json_decode($person->selected_items, true) ?? [];
        }
    
        return view('people', compact('people', 'selectedItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
 
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
        
        $user = auth()->user();
        $facilities = $user->facility_staffs()->get();
        $firstFacility = $facilities->first();
    // dd($firstFacility);
        if ($firstFacility) {
            
            // 名前と生年月日が一致する利用者を検索
        $existingPersonByNameAndDob = $firstFacility->people_facilities()
            ->where('person_name', $request->person_name)
            ->where('date_of_birth', $request->date_of_birth)
            ->first();

        // 受給者番号が一致する利用者を検索
        $existingPersonByJukyuushaNumber = $firstFacility->people_facilities()
            ->where('jukyuusha_number', $request->jukyuusha_number)
            ->first();
            // 名前と生年月日が一致する場合
        if ($existingPersonByNameAndDob) {
            return back()->withInput($request->all())
                         ->withErrors(['duplicate_name_dob' => '同じ名前と生年月日の人がすでに存在します。']);
        }

        // 受給者番号が一致する場合
        if ($existingPersonByJukyuushaNumber) {
            return back()->withInput($request->all())
                         ->withErrors(['duplicate_jukyuusha_number' => '同じ受給者番号の人がすでに存在します。']);
        }
    }
   
        

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
        
        

        // $user = auth()->user();

        // facility_staffsメソッドからuserの情報をゲットする↓
        // $facilities = $user->facility_staffs()->get();
        // $firstFacility = $facilities->first();

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

    public function showSelectedItems($people_id)
{
    $person = Person::findOrFail($people_id);
    $selectedItems = json_decode($person->selected_items, true) ?? [];
    // $selectedItems = $person->selected_items ?? []; // Retrieve selected items or use an empty array if null
    return view('select_item', compact('person', 'selectedItems'));
}

public function updateSelectedItems(Request $request, $id)
    {
        $person = Person::findOrFail($id);
        $selectedItems = $request->input('selected_items', []);
        $person->selected_items = json_encode($selectedItems, JSON_UNESCAPED_UNICODE);
        $person->save();
        return redirect()->route('people.show', $person->id)->with('success', '記録項目が更新されました。');
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
