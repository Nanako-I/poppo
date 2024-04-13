<?php

namespace App\Http\Controllers;

use App\Models\ChildToilet;
use App\Models\Person;
use Illuminate\Http\Request;

class ChildToiletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() {
   //** ↓ 下をコピー ↓ **    
    
		
    $childtoilets = ChildToilet::orderBy('created_at', 'asc')->get();

    return view('hogosha', ['childtoilets' => $childtoilets]);
    
   
}
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create(Request $request)
{
    $people = Person::all(); // Personモデルからデータを取得して$people変数に代入
  
    $person = ChildToilet::findOrFail($request->people_id);
  
    return view('people', compact('people')); // $people変数をビューに渡す
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
        
        $childtoilets = ChildToilet::create([
        'people_id' => $request->people_id,
        'urine_created_at' => $request->urine_created_at,
        'ben_created_at' => $request->ben_created_at,
        'ben_condition' => $request->ben_condition,
        // 'created_at' => $request->created_at,
    ]);
    
    $people = Person::all();
    return view('hogosha', compact('childtoilets', 'people'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    


public function change(Request $request, $people_id)
    {
        //** ↓ 下をコピー ↓ **
        $person = Person::findOrFail($people_id);
        $lastToilet = $person->child_toilets->last();
        return view('childtoiletchange', compact('person', 'lastToilet'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $people_id)
{
  $people = Person::all(); // Personモデルからデータを取得して$people変数に代入
  $person = Person::findOrFail($people_id);
  $lastToilet = $person->child_toilets->last();
    // return view('hogosha',  ['id' => $person->id],compact('people', 'lastFoodTime', 'lastOyatsu'));
    return view('hogosha',  ['id' => $person->id],compact('people', 'lastToilet'));
}
// public function edit(Request $request, $people_id)
// {
//   $people = Person::all(); // Personモデルからデータを取得して$people変数に代入
//   $person = Person::findOrFail($people_id);
//   $lastToilet = null;
// if (!is_null($person->child_toilets)) {
//     $lastToilet = $person->child_toilets->isEmpty() ? null : $person->child_toilets->last();
//     return view('hogosha',  ['id' => $person->id],compact('people', 'lastToilet'));
// }
// }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, ChildToilet $childtoilet)
    {
    
        //データ更新
        $person = Person::find($request->people_id);
        $childtoilet->people_id = $person->id;
        $childtoilet->urine_created_at = $request->urine_created_at;
        $childtoilet->ben_created_at = $request->ben_created_at;
        $childtoilet->ben_condition = $request->ben_condition;
        $childtoilet->save();
        
        $people = Person::all();
        
        return view('hogosha', compact('childtoilet', 'people'));
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
