<?php

namespace App\Http\Controllers;

use App\Models\Lifestyle;
use App\Models\Person;
use Illuminate\Http\Request;

class LifestyleController extends Controller
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
        $lifestyle = Lifestyle::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('lifestyle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    $person = Person::findOrFail($request->people_id);
    return redirect()->route('lifestyle.edit', ['people_id' => $person->id]);
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
        // バリデーションルールを追加
    ]);

    // チェックボックスのデータをJSON形式に変換
    $baggage = json_encode($request->input('baggage', []));
    $clean = json_encode($request->input('clean', []));
    $other = json_encode($request->input('other', []));
    

    $lifestyle = Lifestyle::create([
        'people_id' => $request->people_id,
        'baggage' => $baggage,
        'clean' => $clean,
        'other' => $other,
        'bikou' => $request->bikou,
    ]);

    // 他の処理
    $people = Person::all();
    return view('people', compact('lifestyle', 'people'));
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lifestyle  $lifestyle
     * @return \Illuminate\Http\Response
     */
    public function show($people_id)
{
    $person = Person::findOrFail($people_id);
    $lifestyle = $person->lifestyles;

    return view('people',compact('lifestyle'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lifestyle  $lifestyle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $people_id)
{
    $person = Person::findOrFail($people_id);
    return view('lifestyleedit', ['id' => $person->id],compact('person'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lifestyle  $lifestyle
     * @return \Illuminate\Http\Response
     */
     public function change(Request $request, $people_id)
    {
        $person = Person::findOrFail($people_id);
        $lastLifestyle = $person->lifestyles->last();
        return view('lifestylechange', compact('person', 'lastLifestyle'));
    }
    
    public function update(Request $request, Lifestyle $lifestyle)
    {
    // チェックボックスのデータをJSON形式に変換
    $baggage = json_encode($request->input('baggage', []));
    $clean = json_encode($request->input('clean', []));
    $other = json_encode($request->input('other', []));
    
    $lifestyle = Lifestyle::create([
        'people_id' => $request->people_id,
        'baggage' => $baggage,
        'clean' => $clean,
        'other' => $other,
        'bikou' => $request->bikou,
    ]);
    
        $people = Person::all();
        return view('people', compact('lifestyle', 'people'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lifestyle  $lifestyle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lifestyle $lifestyle)
    {
        //
    }
}
