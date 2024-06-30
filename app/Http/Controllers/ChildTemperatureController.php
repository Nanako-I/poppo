<?php

namespace App\Http\Controllers;

use App\Models\ChildTemperature;
use App\Models\Person;
use Illuminate\Http\Request;

class ChildTemperatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() {
   //** ↓ 下をコピー ↓ **    
    
		
    $childtemperatures = ChildTemperature::orderBy('created_at', 'asc')->get();
// ログインユーザーに関連する人物の情報を取得
        $user = auth()->user();
        $people = $user->people()->get();
    return view('hogosha', ['childtemperatures' => $childtemperatures]);
    
   
}
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create(Request $request)
{
    // $people = Person::all(); // Personモデルからデータを取得して$people変数に代入
  
    $person = ChildTemperature::findOrFail($request->people_id);
    
  // ログインユーザーに関連する人物の情報を取得
        $user = auth()->user();
        $people = $user->people()->get();
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
        
        $childtemperatures = ChildTemperature::create([
        'people_id' => $request->people_id,
        'temperature' => $request->temperature,
        
    ]);
    
     // ログインユーザーに関連する人物の情報を取得
    $user = auth()->user();
    $people = $user->people()->get();
    return view('hogosha', compact('childtemperatures', 'people'));
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
        $lastTemperature = $person->child_temperatures->last();
         // ログインユーザーに関連する人物の情報を取得
        $user = auth()->user();
        $people = $user->people()->get();
        return view('childtemperaturechange', compact('person', 'lastTemperature'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $people_id)
{
//   $people = Person::all(); // Personモデルからデータを取得して$people変数に代入
  $person = Person::findOrFail($people_id);
  $lastTemperature = null;
if (!is_null($person->child_temperatures)) {
    $lastTemperature = $person->child_temperatures->isEmpty() ? null : $person->child_temperatures->last();
}

// ログインユーザーに関連する人物の情報を取得
        $user = auth()->user();
        $people = $user->people()->get();
    return view('hogosha',  ['id' => $person->id],compact('people', 'lastTemperature'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, ChildTemperature $childtemperature)
    {
        $validated = $request->validate([
            // 'kibou' => 'required', // この行でkibouが必須であることを指定
            // 他のフィールドのバリデーションルールもここに追加
        ]);
        
        //データ更新
        $person = Person::find($request->people_id);
        $childtemperature->people_id = $person->id;
        $childtemperature->temperature = $request->temperature;
       
        $childtemperature->save();
        
        // $people = Person::all();
        // ログインユーザーに関連する人物の情報を取得
        $user = auth()->user();
        $people = $user->people()->get();
        return view('hogosha', compact('childtemperature', 'people'));
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
