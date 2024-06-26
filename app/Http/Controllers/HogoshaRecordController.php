<?php

namespace App\Http\Controllers;

use App\Models\ChildCondition;
use App\Models\ChildTemperature;
use App\Models\ChildFood;
use App\Models\ChildToilet;
use App\Models\Bath;
use App\Models\Person;
use Illuminate\Http\Request;

class HogoshaRecordController extends Controller
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
    // $selectedDate = $request->input('selected_date');
    $selectedDate = $request->input('selected_date', now()->format('Y-m-d')); // リクエストから日付を取得、デフォルトは今日
    
    $lastChildCondition = ChildCondition::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
    
    $lastChildTemperature = ChildTemperature::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastChildFood = ChildFood::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastChildToilet = ChildToilet::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $Bathkibou = Bath::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
        return view('hogosharecord', compact('person', 'lastChildCondition', 'lastChildTemperature', 'lastChildFood', 'lastChildToilet', 'Bathkibou','selectedDate'));
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