<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Kyuuin;
use Illuminate\Http\Request;

class KyuuinController extends Controller
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
        $kyuuin = Kyuuin::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('kyuuin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create(Request $request)
{
    $person = Person::findOrFail($request->people_id);
    return redirect()->route('kyuuin.edit', ['people_id' => $person->id]);
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
        
        $kyuuin = Kyuuin::create([
        'people_id' => $request->people_id,
        // 'urine_one' => $request->input('urine_one'), // チェックボックスの値ではなく、テキスト入力フィールドの値を保存
        // 'urine_two' => $request->urine_two,
        // 'urine_three' => $request->urine_three,
       
        // 'urine_amount' => $request->urine_amount,
        'kyuuin' => $request->kyuuin,
        'bikou' => $request->bikou,
        // 'bentsuu' => $request->bentsuu,
        'created_at' => $request->created_at,
        'updated_at' => $request->updated_at,
        
         
    ]);
    // return redirect('people/{id}/edit');
     $people = Person::all();
//   $person = Person::findOrFail($request->people_id);
    // return redirect()->route('toilet.edit', ['people_id' => $person->id]); //
    return view('people', compact('kyuuin', 'people'));
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
    $kyuuins = $person->kyuuins;

    return view('people', compact('kyuuins'));
    
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
    return view('kyuuinedit', ['id' => $person->id],compact('person'));
}

public function change(Request $request, $people_id)
    {
        $person = Person::findOrFail($people_id);
        $lastKyuuin = $person->kyuuins->last();
        
        return view('kyuuinchange', compact('person', 'lastKyuuin'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kyuuin $kyuuin)
    {
    //データ更新
        $person = Person::find($request->people_id);
        $kyuuin->people_id = $person->id;
        $kyuuin->kyuuin = $request->kyuuin;
        $kyuuin->bikou = $request->bikou;
        $kyuuin->created_at = $request->created_at;
        $kyuuin->save();
        
        $people = Person::all();
        
        return view('people', compact('kyuuin', 'people'));
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
