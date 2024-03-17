<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use App\Models\Bloodpressure;
use App\Models\Toilet;
use App\Models\Food;
use App\Models\Water;
use App\Models\Medicine;
use App\Models\Kyuuin;
use App\Models\Tube;
use App\Models\Hossa;
use App\Models\Speech;
use App\Models\Person;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //   / 全件データ取得して一覧表示する↓
        // $people は変数名　Person::でPersonモデルにアクセスする
        // $toilet = Toilet::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        // return view('people',compact('toilet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create(Request $request)
{
    $person = Person::findOrFail($request->people_id);
    return redirect()->route('recordedit', ['people_id' => $person->id]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */


public function show($people_id, Request $request)
{
    $person = Person::findOrFail($people_id);
    $selectedDate = $request->input('selected_date');
    
    $lastFood = Food::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
    
    $lastTemperature = Temperature::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastBloodPressure = Bloodpressure::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastToilet = Toilet::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastWater = Water::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
    
    $lastMedicine = Medicine::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastKyuuin = Kyuuin::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastTube = Tube::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastHossa = Hossa::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastMorningActivity = Speech::where('people_id', $people_id)
    ->whereDate('created_at', $selectedDate)
    ->whereNotNull('morning_activity')
    ->latest()
    ->first();

    $lastAfternoonActivity = Speech::where('people_id', $people_id)
    ->whereDate('created_at', $selectedDate)
    ->whereNotNull('afternoon_activity')
    ->latest()
    ->first();
        
        return view('recordedit', compact('person', 'lastTemperature', 'lastBloodPressure', 'lastToilet', 'lastFood', 'lastWater', 'lastMedicine', 'lastKyuuin', 'lastTube', 'lastHossa' ,'lastMorningActivity', 'lastAfternoonActivity', 'selectedDate'));
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $people_id)
{
    // $person = Person::findOrFail($people_id);
    // return view('toiletedit', ['id' => $person->id],compact('person'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        //
    }
}