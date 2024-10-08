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
use Carbon\Carbon;

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
public function show(Request $request, $people_id)
{
   
    // $person = Person::findOrFail($people_id);
    $person = Person::with(['foods', 'temperatures', 'toilets', 'waters'])->findOrFail($people_id);
    $today = \Carbon\Carbon::now()->toDateString();
    $selectedDate = $request->input('selected_date', \Carbon\Carbon::now()->toDateString());
    $selectedDateStart = \Carbon\Carbon::parse($selectedDate)->startOfDay();
    
    $selectedDateEnd = \Carbon\Carbon::parse($selectedDate)->endOfDay();
    
    $foodsOnSelectedDate = $person->foods->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    $watersOnSelectedDate = $person->waters->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    $medicinesOnSelectedDate = $person->medicines->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    $tubesOnSelectedDate = $person->tubes->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    // $temperaturesOnSelectedDate = $person->temperatures->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    $temperaturesOnSelectedDate = $person->temperatures ? $person->temperatures->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]) : collect();
    // dd($temperaturesOnSelectedDate);
    $bloodpressuresOnSelectedDate = $person->bloodpressures->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    $toiletsOnSelectedDate = $person->toilets->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    $kyuuinsOnSelectedDate = $person->kyuuins ? $person->kyuuins->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]) : collect();
    $hossasOnSelectedDate = $person->hossas ? $person->hossas->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]) : collect();
    $speechesOnSelectedDate = $person->speeches ? $person->speeches->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]) : collect();
    return view('recordedit', compact('person', 'selectedDate','foodsOnSelectedDate',  'watersOnSelectedDate' , 'medicinesOnSelectedDate', 'tubesOnSelectedDate',  'temperaturesOnSelectedDate', 'bloodpressuresOnSelectedDate','toiletsOnSelectedDate','kyuuinsOnSelectedDate', 'hossasOnSelectedDate', 'speechesOnSelectedDate'));
}

// public function show($people_id, Request $request)
// {
//     $person = Person::findOrFail($people_id);
//     $selectedDate = $request->input('selected_date', now()->format('Y-m-d')); // リクエストから日付を取得、デフォルトは今日
    
//     $lastFood = Food::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first();
    
//     $lastTemperature = Temperature::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first();
        
//     $lastBloodPressure = Bloodpressure::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first();
        
//     $lastToilet = Toilet::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first();
        
//     $lastWater = Water::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first();
    
//     $lastMedicine = Medicine::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first();
        
//     $lastKyuuin = Kyuuin::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first();
        
//     $lastTube = Tube::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first();
        
//     $lastHossa = Hossa::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first();
        
//     $lastMorningActivity = Speech::where('people_id', $people_id)
//     ->whereDate('created_at', $selectedDate)
//     ->whereNotNull('morning_activity')
//     ->latest()
//     ->first();

//     $lastAfternoonActivity = Speech::where('people_id', $people_id)
//     ->whereDate('created_at', $selectedDate)
//     ->whereNotNull('afternoon_activity')
//     ->latest()
//     ->first();
        
//         return view('recordedit', compact('person', 'lastTemperature', 'lastBloodPressure', 'lastToilet', 'lastFood', 'lastWater', 'lastMedicine', 'lastKyuuin', 'lastTube', 'lastHossa' ,'lastMorningActivity', 'lastAfternoonActivity', 'selectedDate'));
// }
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