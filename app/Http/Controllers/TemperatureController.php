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
    // return redirect('people/{id}/edit');
     $people = Person::all();
     
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
    
        $people = Person::all();
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