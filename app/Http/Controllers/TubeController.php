<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use App\Models\Tube;
use Illuminate\Http\Request;

class TubeController extends Controller
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
        $tube = Tube::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('tube'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create(Request $request)
{
    $person = Person::findOrFail($request->people_id);
    return redirect()->route('tube.edit', ['people_id' => $person->id]);
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
        
        $tube = Tube::create([
        'people_id' => $request->people_id,
        'user_id_tube' => $request->user_id_tube,
        'created_at' => $request->created_at,
        'tube' => $request->tube,
        'tube_bikou' => $request->tube_bikou,
        'user_id_medicine' => $request->user_id_medicine,
        'created_at' => $request->created_at,
        'medicine' => $request->medicine,
        'medicine_bikou' => $request->medicine_bikou,
        'updated_at' => $request->updated_at, 
    ]);
    // return redirect('people/{id}/edit');
     $people = Person::all();
//   $person = Person::findOrFail($request->people_id);
    // return redirect()->route('toilet.edit', ['people_id' => $person->id]); //
    return view('people', compact('tube', 'people'));
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
    $tubes = $person->tubes;

    return view('people', compact('tubes'));
    
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
    return view('tubeedit', ['id' => $person->id],compact('person'));
}

public function change(Request $request, $people_id)
    {
        $person = Person::findOrFail($people_id);
        $lastTube = $person->tubes->last();
        
        return view('tubechange', compact('person', 'lastTube'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tube $tube)
    {
    //データ更新
        $person = Person::find($request->people_id);
        $user_tube = User::find($request->user_id_tube);
        $user_medicine = User::find($request->user_id_medicine);
        
        $tube->people_id = $person->id;
        $tube->user_id_tube = $user_tube->id;
        $tube->created_at = $request->created_at;
        $tube->tube = $request->tube;
        $tube->tube_bikou = $request->tube_bikou;
        $tube->user_id_medicine = $user_medicine->id;
        
        $tube->medicine = $request->medicine;
        $tube->medicine_bikou = $request->medicine_bikou;
        $tube->created_at = $request->created_at;
        $tube->save();
        
        $people = Person::all();
        
        return view('people', compact('tube', 'people'));
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
