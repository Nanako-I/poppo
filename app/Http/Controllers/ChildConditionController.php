<?php

namespace App\Http\Controllers;

use App\Models\ChildCondition;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;

class ChildConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
   //** ↓ 下をコピー ↓ **    
    
		
    $childconditions = ChildCondition::orderBy('created_at', 'asc')->get();
    // ログインユーザーに関連する人物の情報を取得
    $user = auth()->user();
    $people = $user->people()->get();

    return view('hogosha', ['childconditions' => $childconditions]);
    
    //** ↑ 上をコピー ↑ **
}
    // public function index()
    // {
    // // 
    //     $food = Food::all();
      
    //     return view('people',compact('food'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//   public function create(Request $request)
// {
//     $people = Person::all(); // Personモデルからデータを取得して$people変数に代入
  
//     $person = ChildCondition::findOrFail($request->people_id);
  
//     return view('people', compact('people')); // $people変数をビューに渡す
// }


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
        
        $childconditions = ChildCondition::create([
        'people_id' => $request->people_id,
        'condition' => $request->condition,
    ]);
    
    // $people = Person::all();
    
    // ログインユーザーに関連する人物の情報を取得
    $user = auth()->user();
    $people = $user->people()->get();
    return view('hogosha', compact('childconditions', 'people'));
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
        $lastCondition = $person->child_conditions->last();
       // ログインユーザーに関連する人物の情報を取得
        $user = auth()->user();
        $people = $user->people()->get();
        return view('conditionchange', compact('person', 'lastCondition'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
// public function edit(Request $request, $people_id)
// {
    
//   $people = Person::all(); // Personモデルからデータを取得して$people変数に代入
  
//   $person = Person::findOrFail($people_id);
//   $lastCondition = $person->child_conditions->last();
       
//     return view('hogosha',  ['id' => $person->id],compact('people', 'lastCondition')); // $people変数をビューに渡す
// }

//     public function edit(Request $request, $people_id)
//     {
    
//     // 指定された人物のデータを取得
//     $person = Person::findOrFail($people_id);

//     // 指定された人物に関連するユーザーを取得
//     // $users = $person->users;
//     $user = auth()->user();
//     // 指定された人物のデータを取得
//     $person = Person::findOrFail($people_id);

//     // ログインしているユーザーに関連する人物を取得
//     $people = $user->people()->where('people.id', $people_id)->get();

//     return view('hogosha', compact('people'));
// }

public function edit(Request $request)
    {
    
    
    $user = auth()->user();
   

    // ログインしているユーザーに関連する人物を取得
    // $people = $user->people()->where('people.id', $people_id)->get();
    // ログインしているユーザーに関連する人物を取得
    $people = $user->people_family()->get();

    return view('hogosha', compact('people'));
}


    // 関連するユーザーのそれぞれに関連する人物の情報を取得
    // $people = [];
    // foreach ($users as $user) {
    //     $people[] = $user->people;
    // }

    // return view('hogosha', compact('people'));

    
 // 全てのユーザーを取得
    // $users = User::all();
    // $person = Person::findOrFail($people_id);
    // $people = [];
    // $people[] = $users->people;
    // return view('hogosha', compact('people'));
    
    
        // $users = $this->user->all();
        // 人物を格納する空の配列を定義
//     $people = [];
//         // 1つずつ取り出す
//         foreach ($users as $user) {
//             $people[] = $user->people;
//             // 商品名表示
//             // echo "<br/>{$item->name}のカテゴリたち：";
//             // 商品に紐づくカテゴリーを1つずつ取り出す
//             // foreach ($user->people as $person) {
//             //     // 人物名表示
//             //     echo "{$person->person_name} ";
//       return view('hogosha', compact('people'));
//     // return view('hogosha',  ['id' => $person->id],compact('person')); // $people変数をビューに渡す
// }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, ChildCondition $childcondition)
    {
    
        //データ更新
        $person = Person::find($request->people_id);
        $childcondition->people_id = $person->id;
        $childcondition->condition = $request->condition;
        $childcondition->save();
        
        // $people = Person::all();
        
        // ログインユーザーに関連する人物の情報を取得
        $user = auth()->user();
        $people = $user->people()->get();
        return view('hogosha', compact('childcondition', 'people'));
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
