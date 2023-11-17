<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use App\Models\Toilet;
use App\Models\Food;
use App\Models\Speech;
use App\Models\Person;
use Illuminate\Http\Request;

class RecordController extends Controller
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
    //   $storeData = $request->validate([
            // 'food' => 'required|max:255',
            // 'staple_food' => 'required|max:255',
            // 'side_dish' => 'required|max:255',
            // 'medicine' => 'required|max:255',
        // ]);
        // バリデーションした内容を保存する↓
        
        // $toilet = Toilet::create([
        // 'people_id' => $request->people_id,
        // 'urine_one' => $request->urine_one,
        // 'urine_two' => $request->urine_two,
        // 'urine_three' => $request->urine_three,
        // 'ben_one' => $request->ben_one,
        // 'ben_two' => $request->ben_two,
        // 'ben_three' => $request->ben_three,
        // 'filename' => $request->filename,
         
    // ]);
    // return redirect('people/{id}/edit');
//   $person = Person::findOrFail($request->people_id);
//     return redirect()->route('food.edit', ['people_id' => $person->id]); //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show($people_id)
{
    $person = Person::findOrFail($people_id);
    $temperatures = Temperature::where('people_id', $people_id)->get();
    $toilets = Toilet::where('people_id', $people_id)->get();
    $foods = Food::where('people_id', $people_id)->get();
    $speeches = Speech::where('people_id', $people_id)->get();
    
    return view('recordedit', compact('person', 'temperatures', 'toilets', 'foods', 'speeches'));
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