<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Models\Person;
use Carbon\Carbon;
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


    $people = Person::all();
     // 二重送信防止
    $request->session()->regenerateToken();
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
     
    public function change(Request $request, $people_id, $id)
    {
        $person = Person::findOrFail($people_id);
        // $lastTime = $person->times->last();
        $lastTime = Time::findOrFail($id);


        // 利用時間合計を計算するためのコード↓
        $startTime = Carbon::parse($lastTime->start_time);
        $endTime = Carbon::parse($lastTime->end_time);
        // dd($startTime, $endTime);

        // 開始時間と終了時間の差を計算
        $diffInHours = $startTime->diffInHours($endTime);
        // dd($diffInHours);
        $diffInMinutes = $startTime->diffInMinutes($endTime) % 60;

        // 合計利用時間を文字列にフォーマット
        $totalUsageTime = $diffInHours . '時間' . $diffInMinutes . '分';

        return view('timechange', compact('person','totalUsageTime', 'lastTime'));
    }
    
    public function update(Request $request, Time $time, $id)
    {
        // チェックボックスのデータをJSON形式に変換
        $pick_up = json_encode($request->input('pick_up', []));
        $send = json_encode($request->input('send', []));
        
        // IDをリクエストから取得
        $id = $request->id;
        // Time モデルのレコードを取得
        $time = Time::find($id);

        // レコードが存在しない場合のエラーハンドリング
        if (!$time) {
            return redirect()->back()->with('error', '指定されたデータが見つかりません。');
        }

        $form = $request->all();
        $time->fill($form)->save();
    
        $people = Person::all();
        // 二重送信防止
        $request->session()->regenerateToken();

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