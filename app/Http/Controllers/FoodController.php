<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Person;
use Illuminate\Http\Request;

class FoodController extends Controller
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
        $food = Food::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('food'));
    }

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
        'food' => $request->food,
        'staple_food' => $request->staple_food,
        'side_dish' => $request->side_dish,
        'medicine' => $request->medicine,
        'medicine_name' => $request->medicine_name,
        'bikou' => $request->bikou,
         
    ]);
    // return redirect('people/{id}/edit');
   $person = Person::findOrFail($request->people_id);
    return redirect()->route('food.edit', ['people_id' => $person->id]); //
    // return view('people');
    // return view('people', ['people' => Person::all()]);
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


//  public function showAmountFood($id)
// {
    
//     $person = Person::findOrFail($id);
//     $foods = $person->foods;
// //     // $foods = $person->foods;
// //     // $foods = Food::where('people_id', $people_id)->get();

// //     return view('people', compact('staple_foods'));
//     return view('people', compact('foods'));
// }

// public function show($id)
// {
//     $person = Person::findOrFail($id);
//     $Laststaple_food = null;

//     if (is_countable($person->staple_foods) && count($person->staple_foods) > 0) {
//         $Laststaple_food = $person->staple_foods->last();

//         if ($Laststaple_food->created_at->diffInHours(now()) >= 6) {
//             $Laststaple_food = null;
//         }
//     }

//     $foods = $person->foods;

//     return view('people', compact('person', 'Laststaple_food', 'foods'));
// }


// public function show($id)
// {
//     $person = Person::findOrFail($id);
//     $staple_food = null;
//     if (is_countable($person->staple_foods) && count($person->staple_foods) > 0) {
//         foreach ($person->staple_foods as $staple) {
//             if ($staple->staple_food) {
//                 $staple_food = $staple->staple_food;
//                 $hours_diff = now()->diffInHours($staple_food->created_at);
//                 if ($hours_diff >= 6) {
//                     $staple_food = null;
//                 }
//                 break;
//             }
//         }
//     }
//     $foods = $person->foods;
//     return view('people', compact('person', 'staple_food', 'foods'));
// }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $people_id)
{
    $person = Person::findOrFail($people_id);
    return view('foodedit', ['id' => $person->id],compact('person'));
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