<?php

namespace App\Http\Controllers;

use App\Models\Bloodpressure;
use App\Models\Person;
use Illuminate\Http\Request;

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
         
    ]);
    
  $people = Person::all();
//   $person = Person::findOrFail($request->people_id);
//     return redirect()->route('bloodpressure.edit', ['people_id' => $person->id]); 
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

    
    // $person = Person::findOrFail($id);
    // $bloodpressures = $person->bloodpressures;
    $bloodpressure = $person->bloodpressures;
    $people = Person::all(); // ここで $people を取得
    // @dd($bloodpressures);
    return view('people', compact('bloodpressure'));
    
    
    // $temperature = Temperature::findOrFail($id);

    // return view('temperaturelist', compact('temperature'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
     public function edit($people_id)
{
    $person = Person::findOrFail($people_id);
    $bloodpressure = $person->bloodpressures;

    $people = Person::all(); // ここで $people を取得
    return view('bloodpressureedit', ['id' => $person->id],compact('person'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Speech $speech)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speech $speech)
    {
        //
    }
}