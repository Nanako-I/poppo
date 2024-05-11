<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TemperatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     
    
    public function index()
    {
       $temperature = Temperature::all();
       return view('people',compact('temperature'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     
   public function create(Request $request)
{
    $person = Temperature::findOrFail($request->people_id);
    return redirect()->route('temperature.edit', ['people_id' => $person->id]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $storeData = $request->validate([
            
        ]);
        // バリデーションした内容を保存する↓
        
        $temperature = Temperature::create([
        'people_id' => $request->people_id,	
        'temperature' => $request->temperature,
        'bikou' => $request->bikou,
        'created_at' => $request->created_at,
        
    ]);
        $user = auth()->user();
        
        // Facility.phpのfacility_staffsメソッドからuserの情報をゲットする↓
        $facilities = $user->facility_staffs()->get();
        
        // userに紐づく施設の情報を取る↓
        $firstFacility = $facilities->first();
        // Facility.phpのpeople_facilitiesメソッドから施設に紐づく利用者(people)の情報を取得する↓
        $people= $firstFacility->people_facilities()->get();
         
         // 二重送信防止
        $request->session()->regenerateToken();

        return view('people', compact('temperature', 'people'));
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\temperature  $temperature
     * @return \Illuminate\Http\Response
     */
    public function show($people_id)
{
    
    $person = Person::findOrFail($people_id);
    $temperature = $person->temperatures;

    
    return view('people',compact('temperature'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\temperature  $temperature
     * @return \Illuminate\Http\Response
     */
//     public function edit($id)
// {
//     $person = Person::findOrFail($request->people_id);
//     return view('temperature.edit', ['id' => $person->id],compact('person'));
// }
public function edit(Request $request, $people_id)
{
   
    $person = Person::findOrFail($people_id);
    $today = \Carbon\Carbon::now()->toDateString();
    $selectedDate = $request->input('selected_date', Carbon::now()->toDateString());
    $selectedDateStart = Carbon::parse($selectedDate)->startOfDay();
    $selectedDateEnd = Carbon::parse($selectedDate)->endOfDay();

    $temperaturesOnSelectedDate = $person->temperatures->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    return view('temperatureedit', compact('person', 'selectedDate', 'temperaturesOnSelectedDate'));
}

// public function edit(Request $request, $people_id)
// {
//     $user = auth()->user();
//     //  dd($user);
//     // facility_staffsメソッドからuserの情報をゲットする↓
//     $facilities = $user->facility_staffs()->get();
//     // dd($facilities);
//     $firstFacility = $facilities->first();

//     // dd($firstFacility);
//     // ↑これで$facilityが取れている
//     $people = $firstFacility->people_facilities()->get();
        
//     $person = Person::findOrFail($people_id);
//     $today = \Carbon\Carbon::now()->toDateString();
//     $selectedDate = $request->input('selected_date', Carbon::now()->toDateString());
//     $selectedDateStart = Carbon::parse($selectedDate)->startOfDay();
//     $selectedDateEnd = Carbon::parse($selectedDate)->endOfDay();

//     $temperaturesOnSelectedDate = $person->temperatures->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
//     return view('temperatureedit', compact('people', 'selectedDate', 'temperaturesOnSelectedDate'));
// }

// public function change(Request $request, $people_id, $id)
// {
//     $user = auth()->user();
//     // ユーザーに関連付けられている施設を取得
//     $facilities = $user->facility_staffs()->get();
//     // 最初の施設を取得
//     $firstFacility = $facilities->first();

//     // 特定のpeople_idに対応するpeopleを取得
//     $person = $firstFacility->people_facilities()->where('people_facilities.id', $people_id)->firstOrFail();


//     // すべてのユーザーを取得 (この行が不要な場合は削除)
//     $users = User::all();

//     // 指定されたidのTemperatureを取得
//     $temperature = Temperature::findOrFail($id);

//     // ビューにデータを渡す
//     return view('temperaturechange', compact('person', 'temperature', 'users'));
    
// }

public function change(Request $request, $people_id, $id)
    {
        // ユーザーを取得
        $user = User::findOrFail($people_id);
        // ユーザーが持つ体温の記録からユーザーIDを取得
        $user_id = $user->id;
    
        // すべてのユーザーを取得
        $users = User::all();
        $person = Person::findOrFail($people_id);
        $temperature = Temperature::findOrFail($id);
        return view('temperaturechange', compact('person', 'temperature','users'));
    }
// public function change(Request $request, $people_id, $id)
//     {
//     $user = auth()->user();
//     //  dd($user);
//     // facility_staffsメソッドからuserの情報をゲットする↓
//     $facilities = $user->facility_staffs()->get();
//     // dd($facilities);
//     $firstFacility = $facilities->first();

//     // dd($firstFacility);
//     // ↑これで$facilityが取れている
//     $people= $firstFacility->people_facilities()->get();
//     // すべてのユーザーを取得
//     $users = User::all();
//     $person = Person::findOrFail($people_id);
//     // dd($person);
//     $temperature = Temperature::findOrFail($id);
//     return view('temperaturechange', compact('person', 'temperature','users','people'));
//     // return view('temperaturechange', compact('person', 'temperature'));
//     // return view('people',compact('people'));

//     }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\temperature  $temperature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Temperature $temperature)
    {
    //データ更新
        $temperature = Temperature::find($request->id);
        $form = $request->all();
        $temperature->fill($form)->save();
    
        $request->session()->regenerateToken();
        $user = auth()->user();
        //  dd($user);
        // facility_staffsメソッドからuserの情報をゲットする↓
        $facilities = $user->facility_staffs()->get();
        // dd($facilities);
        $firstFacility = $facilities->first();
    
        // dd($firstFacility);
        // ↑これで$facilityが取れている
        $people= $firstFacility->people_facilities()->get();
        // $people = Person::all();
        // 二重送信防止
        $request->session()->regenerateToken();
        return view('people', compact('temperature', 'people'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\temperature  $temperature
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $temperature = Temperature::find($id);
    if ($temperature) {
        $temperature->delete();
    }
        return redirect()->route('people.index');
    }
}