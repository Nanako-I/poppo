<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Person;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index() {
   //** ↓ 下をコピー ↓ **    
    
		
    $foods = Food::orderBy('created_at', 'asc')->get();

    return view('foods', ['foods' => $foods]);
    
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
   public function create(Request $request)
{
    $person = Food::findOrFail($request->people_id);
    // return redirect()->route('food.edit', ['people_id' => $person->id]);
    // return view('people');
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
            // 'food' => 'required|max:255',
            // 'staple_food' => 'required|max:255',
            // 'side_dish' => 'required|max:255',
            // 'medicine' => 'required|max:255',
        ]);
        // バリデーションした内容を保存する↓
        
        $food = Food::create([
        'people_id' => $request->people_id,
        'lunch' => $request->lunch,
        'lunch_bikou' => $request->lunch_bikou,
        'oyatsu' => $request->oyatsu,
        'oyatsu_bikou' => $request->oyatsu_bikou,
        'staple_food' => $request->staple_food,
        'side_dish' => $request->side_dish,
        'medicine' => $request->medicine,
        'medicine_name' => $request->medicine_name,
        'bikou' => $request->bikou,
         
    ]);
    // return redirect('people/{id}/edit');
    $people = Person::all();
//   $person = Person::findOrFail($request->people_id);
    // return redirect()->route('food.edit', ['people_id' => $person->id]); //
     $request->session()->regenerateToken();
    return view('people', compact('food', 'people'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function showFood($id)
{
    
    $person = Person::findOrFail($id);
    $foods = $person->foods;
//     // $foods = $person->foods;
//     // $foods = Food::where('people_id', $people_id)->get();

//     return view('people', compact('staple_foods'));
    return view('people', compact('foods'));
}

// public function change($people_id){  // 編集には、id情報 と 記事データが必要

// $person = Person::findOrFail($people_id);
//   $message = '記事の編集： '.$id;    // 表示用
//   $food = Food::find($id);  // 編集するレコードをid情報から取得
//   return view('edit', ['message'=>$message, 'article'=>$article]);  // 編集ページに渡す
// }

public function change(Request $request, $people_id, $id)
// public function change(Food $food)
    {
        
        $person = Person::findOrFail($people_id);
        $food = Food::findOrFail($id);
      
       
        return view('foodchange', compact('person', 'food'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
//     public function edit(Request $request, $people_id)
// {
//     $person = Person::findOrFail($people_id);
//     return view('food', ['id' => $person->id],compact('person'));
// }
public function edit(Request $request, $people_id)
{
    $person = Person::findOrFail($people_id);
    $today = \Carbon\Carbon::now()->toDateString();
    $selectedDate = $request->input('selected_date', Carbon::now()->toDateString());
    $selectedDateStart = Carbon::parse($selectedDate)->startOfDay();
    $selectedDateEnd = Carbon::parse($selectedDate)->endOfDay();

    $foodsOnSelectedDate = $person->foods->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    return view('foodedit', compact('person', 'selectedDate', 'foodsOnSelectedDate'));
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
        $person = Person::find($request->people_id);

    //データ更新
        $food = Food::find($request->id);
        $form = $request->all();
        $food->fill($form)->save();
        // dd($food);
        $people = Person::all();
        
        // セッショントークンを再生成
        $request->session()->regenerateToken();
        return view('people', compact('food', 'people'));
    }
    
 
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $food = Food::find($id);
    if ($food) {
        $food->delete();
    }
        return redirect()->route('people.index');
    }
}