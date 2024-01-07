<?php

namespace App\Http\Controllers;

use App\Models\Creative;
use App\Models\Person;
use Illuminate\Http\Request;

class CreativeController extends Controller
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
        $creative = Creative::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('creative'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    $person = Person::findOrFail($request->people_id);
    return redirect()->route('creative.edit', ['people_id' => $person->id]);
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
    $craft = json_encode($request->input('craft', []));
    $cooking = json_encode($request->input('cooking', []));
    $other = json_encode($request->input('other', []));
    

    $creative = Creative::create([
        'people_id' => $request->people_id,
        'craft' => $craft,
        'cooking' => $cooking,
        'other' => $other,
        'bikou' => $request->bikou,
    ]);

    // 他の処理
    $people = Person::all();
    return view('people', compact('creative', 'people'));
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Creative  $creative
     * @return \Illuminate\Http\Response
     */
    public function show($people_id)
{
    $person = Person::findOrFail($people_id);
    $creative = $person->creatives;

    return view('people',compact('creative'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Creative  $creative
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $people_id)
{
    $person = Person::findOrFail($people_id);
    return view('creativeedit', ['id' => $person->id],compact('person'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Creative  $creative
     * @return \Illuminate\Http\Response
     */
     
    public function change(Request $request, $people_id)
    {
        $person = Person::findOrFail($people_id);
        $lastCreative = $person->creatives->last();
        return view('creativechange', compact('person', 'lastCreative'));
    }
    
    public function update(Request $request, Creative $creative)
    {
    // チェックボックスのデータをJSON形式に変換
    $craft = json_encode($request->input('craft', []));
    $cooking = json_encode($request->input('cooking', []));
    $other = json_encode($request->input('other', []));
    
    $creative = Creative::create([
        'people_id' => $request->people_id,
        'craft' => $craft,
        'cooking' => $cooking,
        'other' => $other,
        'bikou' => $request->bikou,
    ]);
    
        $people = Person::all();
        return view('people', compact('creative', 'people'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Creative  $creative
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creative $creative)
    {
        //
    }
}
