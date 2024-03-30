<?php

namespace App\Http\Controllers;

use App\Models\ChildFood;
use App\Models\Person;
use Illuminate\Http\Request;

class ChildFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
   //** ↓ 下をコピー ↓ **    
    
		
    $childfoods = ChildFood::orderBy('created_at', 'asc')->get();

    return view('hogosha', ['childfoods' => $childfoods]);
    
   
}
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create(Request $request)
{
    $people = Person::all(); // Personモデルからデータを取得して$people変数に代入
  
    $person = ChildFood::findOrFail($request->people_id);
  
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
        
        $childfoods = ChildFood::create([
        'people_id' => $request->people_id,
        'food_created_at' => $request->food_created_at,
        'oyatsu' => $request->oyatsu,
    ]);
    
    $people = Person::all();
    return view('hogosha', compact('childfoods', 'people'));
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
        // dd($person->foods);
        // $lastFoodTime = $person->food_created_at->last();
        // $lastOyatsu = $person->oyatsu->last();
        $lastFood = $person->child_foods->last();
        return view('childfoodchange', compact('person', 'lastFood'));
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
  $lastFood = $person->child_foods->last();
    // return view('hogosha',  ['id' => $person->id],compact('people', 'lastFoodTime', 'lastOyatsu'));
    return view('hogosha',  ['id' => $person->id],compact('people', 'lastFood'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, ChildFood $childfood)
    {
    
        //データ更新
        $person = Person::find($request->people_id);
        $childfood->people_id = $person->id;
        $childfood->food_created_at = $request->food_created_at;
        $childfood->oyatsu = $request->oyatsu;
        $childfood->save();
        
        $people = Person::all();
        
        return view('hogosha', compact('childfood', 'people'));
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
