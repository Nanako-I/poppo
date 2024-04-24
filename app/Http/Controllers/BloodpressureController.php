<?php

namespace App\Http\Controllers;

use App\Models\Bloodpressure;
use App\Models\Person;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BloodpressureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $bloodpressure = Bloodpressure::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('bloodpressure'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(Request $request)
{
    $person = Person::findOrFail($request->people_id);
    // return redirect()->route('speech.edit', ['people_id' => $person->id]);
    return view('people', ['people' => Person::all()]);
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
        
        $bloodpressure = Bloodpressure::create([
        'people_id' => $request->people_id,
        'max_blood' => $request->max_blood,
        'min_blood' => $request->min_blood,
        'pulse' => $request->pulse,
        'spo2' => $request->spo2,
        'bikou' => $request->bikou,
        'created_at' => $request->created_at,
    ]);
    
    $people = Person::all();
    $request->session()->regenerateToken();
    return view('people', compact('bloodpressure', 'people'));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
     public function show($people_id)
{
    $person = Person::findOrFail($people_id);
    $bloodpressure = $person->bloodpressures;

    $people = Person::all(); // ここで $people を取得
    return view('bloodpressures', ['id' => $person->id],compact('person'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
     public function edit(Request $request, $people_id)
{
   
    $person = Person::findOrFail($people_id);
    $today = \Carbon\Carbon::now()->toDateString();
    $selectedDate = $request->input('selected_date', Carbon::now()->toDateString());
    $selectedDateStart = Carbon::parse($selectedDate)->startOfDay();
    $selectedDateEnd = Carbon::parse($selectedDate)->endOfDay();

    $bloodpressuresOnSelectedDate = $person->bloodpressures->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    return view('bloodpressuresedit', compact('person', 'selectedDate', 'bloodpressuresOnSelectedDate'));
}

public function change(Request $request, $people_id, $id)
    {
        $person = Person::findOrFail($people_id);
        $bloodpressure = Bloodpressure::findOrFail($id);
        return view('bloodpressurechange', compact('person', 'bloodpressure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bloodpressure $bloodpressure)
    {
    //データ更新
        $bloodpressure = Bloodpressure::find($request->id);
        $form = $request->all();
        $bloodpressure->fill($form)->save();
    
        $request->session()->regenerateToken();
    
        $people = Person::all();
        // 二重送信防止
        $request->session()->regenerateToken();
        return view('people', compact('bloodpressure', 'people'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $bloodpressure = Bloodpressure::find($id);
    if ($bloodpressure) {
        $bloodpressure->delete();
    }
        return redirect()->route('people.index');
    }
}