<?php

namespace App\Http\Controllers;

use App\Models\Time;
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
use App\Models\Activity;
use App\Models\Training;
use App\Models\Lifestyle;
use App\Models\Creative;
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

    // hanamaruの項目↓
    $lastTime = Time::where('people_id', $people_id)
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
    
    $lastActivity = Activity::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastTraining = Training::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastLifestyle = Lifestyle::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastCreative = Creative::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();    
        // return view('recordedit', compact('person', 'lastTime', 'lastTemperature', 'lastBloodPressure', 'lastToilet', 'lastFood', 'lastMorningActivity', 'lastAfternoonActivity', 'lastActivity', 'lastTraining', 'lastLifestyle', 'lastCreative', 'selectedDate'));

    return view('recordedit', compact('person', 'selectedDate','foodsOnSelectedDate',  'watersOnSelectedDate' , 'medicinesOnSelectedDate', 'tubesOnSelectedDate',  'temperaturesOnSelectedDate', 'bloodpressuresOnSelectedDate','toiletsOnSelectedDate','kyuuinsOnSelectedDate', 'hossasOnSelectedDate', 'speechesOnSelectedDate' , 'lastTime', 'lastMorningActivity', 'lastAfternoonActivity', 'lastActivity', 'lastTraining', 'lastLifestyle', 'lastCreative',));
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