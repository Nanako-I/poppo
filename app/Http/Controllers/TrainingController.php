<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Chat;

use Spatie\Permission\Models\Role as SpatieRole;
use App\Enums\RoleType;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use App\Enums\PermissionType;
use App\Enums\RoleType as RoleEnums;
use App\Enums\Role as RoleEnum;

class TrainingController extends Controller
{
    
    public function store(Request $request)
{
    $storeData = $request->validate([
        // バリデーションルールを追加
    ]);

    // チェックボックスのデータをJSON形式に変換
    $communication = json_encode($request->input('communication', []));
    $exercise = json_encode($request->input('exercise', []));
    $reading_writing = json_encode($request->input('reading_writing', []));
    $calculation = json_encode($request->input('calculation', []));
    $homework = json_encode($request->input('homework', []));
    $shopping = json_encode($request->input('shopping', []));
    $training_other = json_encode($request->input('training_other', []));

    $training = Training::create([
        'people_id' => $request->people_id,
        'communication' => $communication,
        'exercise' => $exercise,
        'reading_writing' => $reading_writing,
        'calculation' => $calculation,
        'homework' => $homework,
        'shopping' => $shopping,
        'training_other' => $training_other,
        'training_other_sentence' => $request->training_other_sentence,
    ]);

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



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\training  $training
     * @return \Illuminate\Http\Response
     */
     public function change(Request $request, $people_id)
    {
        $person = Person::findOrFail($people_id);
        $lastTraining = $person->trainings->last();
        return view('trainingchange', compact('person', 'lastTraining'));
    }
    
    // 登録したトレーニング内容変更
    public function update(Request $request, Training $training)
    {
    
     // チェックボックスのデータをJSON形式に変換
    $communication = json_encode($request->input('communication', []));
    $exercise = json_encode($request->input('exercise', []));
    $reading_writing = json_encode($request->input('reading_writing', []));
    $calculation = json_encode($request->input('calculation', []));
    $homework = json_encode($request->input('homework', []));
    $shopping = json_encode($request->input('shopping', []));
    $training_other = json_encode($request->input('training_other', []));

    $training = Training::create([
        'people_id' => $request->people_id,
        'communication' => $communication,
        'exercise' => $exercise,
        'reading_writing' => $reading_writing,
        'calculation' => $calculation,
        'homework' => $homework,
        'shopping' => $shopping,
        'training_other' => $training_other,
        'training_other_sentence' => $request->training_other_sentence,
    ]);
    
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
    
}
