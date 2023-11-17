<?php

namespace App\Http\Controllers;

use App\Models\Toilet;
use App\Models\Person;
use Illuminate\Http\Request;

class ToiletController extends Controller
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
        $toilet = Toilet::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('toilet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create(Request $request)
{
    $person = Person::findOrFail($request->people_id);
    return redirect()->route('toilet.edit', ['people_id' => $person->id]);
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
        
        $toilet = Toilet::create([
        'people_id' => $request->people_id,
        'urine_one' => $request->input('urine_one'), // チェックボックスの値ではなく、テキスト入力フィールドの値を保存
        'urine_two' => $request->urine_two,
        'urine_three' => $request->urine_three,
       
        'urine_amount' => $request->urine_amount,
        'ben_condition' => $request->ben_condition,
        'ben_amount' => $request->ben_amount,
        'bentsuu' => $request->bentsuu,
        'created_at' => $request->created_at,
        'updated_at' => $request->updated_at,
        'filename' => $request->filename,
        'bikou' => $request->bikou,
         
    ]);
    // return redirect('people/{id}/edit');
     $people = Person::all();
//   $person = Person::findOrFail($request->people_id);
    // return redirect()->route('toilet.edit', ['people_id' => $person->id]); //
    return view('people', compact('toilet', 'people'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    
    $person = Person::findOrFail($id);
    $toilets = $person->toilets;

    return view('people', compact('toilets'));
    
    // $temperature = Temperature::findOrFail($id);

    // return view('temperaturelist', compact('temperature'));
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
    return view('toiletedit', ['id' => $person->id],compact('person'));
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