<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Models\Person;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $time = Time::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('time'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    $person = Person::findOrFail($request->people_id);
    return redirect()->route('time.edit', ['people_id' => $person->id]);
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
        // バリデーションルールを追加
    ]);

    // チェックボックスのデータをJSON形式に変換
    $pick_up = json_encode($request->input('pick_up', []));
    $send = json_encode($request->input('send', []));
    

    $time = Time::create([
        'people_id' => $request->people_id,
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'school' => $request->school,
        'pick_up' => $pick_up,
        'send' => $send,
       
    ]);

    // 他の処理
    $people = Person::all();
    return view('people', compact('time', 'people'));
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function show($people_id)
{
    $person = Person::findOrFail($people_id);
    $time = $person->times;

    return view('people',compact('time'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $people_id)
{
    $person = Person::findOrFail($people_id);
    return view('timeedit', ['id' => $person->id],compact('person'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
     
    public function change(Request $request, $people_id)
    {
        $person = Person::findOrFail($people_id);
        $lastTime = $person->times->last();
        return view('timechange', compact('person', 'lastTime'));
    }
    
    public function update(Request $request, Time $time)
    {
    // チェックボックスのデータをJSON形式に変換
    $pick_up = json_encode($request->input('pick_up', []));
    $send = json_encode($request->input('send', []));
    
    $time = Time::create([
        'people_id' => $request->people_id,
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'school' => $request->school,
        'pick_up' => $pick_up,
        'send' => $send,
    ]);
    
        $people = Person::all();
        return view('people', compact('time', 'people'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy(Time $time)
    {
        //
    }
}
