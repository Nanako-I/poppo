<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use App\Models\Water;
use Illuminate\Http\Request;
use Carbon\Carbon;


class WaterController extends Controller
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
        $water = Water::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('water'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create(Request $request)
{
    $person = Person::findOrFail($request->people_id);
    return redirect()->route('water.edit', ['people_id' => $person->id]);
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
        
        $water = Water::create([
        'people_id' => $request->people_id,
        'user_id_water' => $request->user_id_water,
        'created_at' => $request->created_at,
        'water' => $request->water,
        'water_bikou' => $request->water_bikou,
        'updated_at' => $request->updated_at, 
    ]);
    // return redirect('people/{id}/edit');
     $people = Person::all();
     
     // 二重送信防止
     $request->session()->regenerateToken();

    return view('people', compact('water', 'people'));
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
    $waters = $person->waters;

    return view('people', compact('waters'));
    
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
    $today = \Carbon\Carbon::now()->toDateString();
    $selectedDate = $request->input('selected_date', Carbon::now()->toDateString());
    $selectedDateStart = Carbon::parse($selectedDate)->startOfDay();
    $selectedDateEnd = Carbon::parse($selectedDate)->endOfDay();

    $watersOnSelectedDate = $person->waters->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    return view('wateredit', compact('person', 'selectedDate', 'watersOnSelectedDate'));
}


public function change(Request $request, $people_id, $id)
    {
        $person = Person::findOrFail($people_id);
        $water = Water::findOrFail($id);
        return view('waterchange', compact('person', 'water'));
    }
    
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
  

    public function update(Request $request, Water $water)
    {
    //データ更新
        $water = Water::find($request->id);
        $form = $request->all();
        $water->fill($form)->save();
    
        $request->session()->regenerateToken();
    
        $people = Person::all();
        // 二重送信防止
        $request->session()->regenerateToken();
        return view('people', compact('water', 'people'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
        /**
     * 削除処理
     */
    public function destroy($id)
    {
       
        $water = Water::find($id);
    if ($water) {
        $water->delete();
    }
        return redirect()->route('people.index');
    }

}
