<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use App\Models\Hossa;
use Illuminate\Http\Request;

class HossaController extends Controller
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
        $hossa = Hossa::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('hossa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create(Request $request)
{
    $person = Person::findOrFail($request->people_id);
    return redirect()->route('hossa.edit', ['people_id' => $person->id]);
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
        
        $hossa = Hossa::create([
        'people_id' => $request->people_id,
        'user_id_hossa' => $request->user_id_hossa,
        'created_at' => $request->created_at,
        'hossa' => $request->hossa,
        'hossa_bikou' => $request->hossa_bikou,
        'updated_at' => $request->updated_at, 
    ]);
    // return redirect('people/{id}/edit');
     $people = Person::all();
//   $person = Person::findOrFail($request->people_id);
    // return redirect()->route('toilet.edit', ['people_id' => $person->id]); //
    return view('people', compact('hossa', 'people'));
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
    $hossas = $person->hossas;

    return view('people', compact('hossas'));
    
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
    return view('hossaedit', ['id' => $person->id],compact('person'));
}

public function change(Request $request, $people_id)
    {
        $person = Person::findOrFail($people_id);
        $lastHossa = $person->hossas->last();
        
        return view('hossachange', compact('person', 'lastHossa'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hossa $hossa)
    {
    //データ更新
        $person = Person::find($request->people_id);
        $user_hossa = User::find($request->user_id_hossa);
        $hossa->people_id = $person->id;
        $hossa->user_id_hossa = $user_hossa->id;
        $hossa->hossa = $request->hossa;
        $hossa->hossa_bikou = $request->hossa_bikou;
        $hossa->created_at = $request->created_at;
        $hossa->save();
        
        $people = Person::all();
        
        return view('people', compact('hossa', 'people'));
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
