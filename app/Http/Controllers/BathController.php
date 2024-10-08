<?php

namespace App\Http\Controllers;

use App\Models\Bath;
use App\Models\Person;
use Illuminate\Http\Request;

class BathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() {
   //** ↓ 下をコピー ↓ **    
    
		
    $baths = Bath::orderBy('created_at', 'asc')->get();
// ログインユーザーに関連する人物の情報を取得
    $user = auth()->user();
    $people = $user->people()->get();
    return view('hogosha', ['baths' => $baths]);
    
   
}
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create(Request $request)
{
   $person = Bath::findOrFail($request->people_id);
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
        
        $baths = Bath::create([
        'people_id' => $request->people_id,
        'kibou' => $request->kibou,
        
    ]);
    
    // ログインユーザーに関連する人物の情報を取得
    $user = auth()->user();
    $people = $user->people()->get();
    return view('hogosha', compact('baths', 'people'));
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
        $lastBath = $person->baths->last();
        // ログインユーザーに関連する人物の情報を取得
        $user = auth()->user();
        $people = $user->people()->get();
        return view('childbathchange', compact('person', 'lastBath'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $people_id)
{
    $person = Person::findOrFail($people_id);
    $lastBath = null;
if (!is_null($person->baths)) {
    $lastBath = $person->baths->isEmpty() ? null : $person->baths->last();
}


    // ログインユーザーに関連する人物の情報を取得
        $user = auth()->user();
        $people = $user->people()->get();
    return view('hogosha',  ['id' => $person->id],compact('people', 'lastBath'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Bath $bath)
    {
        $validated = $request->validate([
            // 'kibou' => 'required', // この行でkibouが必須であることを指定
            // 他のフィールドのバリデーションルールもここに追加
        ]);
        
        //データ更新
        $person = Person::find($request->people_id);
        $bath->people_id = $person->id;
        $bath->kibou = $request->kibou;
       
        $bath->save();
        
        // ログインユーザーに関連する人物の情報を取得
        $user = auth()->user();
        $people = $user->people()->get();
        
        return view('hogosha', compact('bath', 'people'));
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
