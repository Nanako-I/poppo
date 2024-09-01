<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use App\Models\Hossa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
    // バリデーションルールとメッセージを定義
    $rules = [
        'created_at' => 'required', // 日時の登録を必須にする
        'filename' => 'mimes:mp4,mov,x-ms-wmv,mpeg,avi|max:2048', // 2MB = 2048KB
    ];
    $messages = [
        'created_at.required' => '時間の登録は必須です。',
        'filename.max' => 'ファイルサイズが大きすぎます。2MB以下のファイルを選択してください。',
        'uploaded' => 'ファイルサイズが大きすぎます。2MB以下のファイルを選択してください。',
        'mimes' => '動画ファイルを選択してください。（動画ファイルはmp4,mov,x-ms-wmv,mpeg,aviのいずれかのタイプにしてください）',
    ];

    // バリデーション実行
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // 画像保存
    $directory = 'public/sample/hossa_photo';
    $filename = null;
    $filepath = null;

    if ($request->hasFile('filename')) {
        $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
        $request->file('filename')->storeAs($directory, $filename);
        $filepath = $directory . '/' . $filename;
    }

    // バリデーションした内容を保存する
    $hossa = Hossa::create([
        'people_id' => $request->people_id,
        'user_id_hossa' => $request->user_id_hossa,
        'created_at' => $request->created_at,
        'hossa' => $request->hossa,
        'hossa_bikou' => $request->hossa_bikou,
        'filename' => $filename,
        'path' => $filepath,
    ]);

    // セッショントークンを再生成
    $request->session()->regenerateToken();

    $people = Person::all();

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
    $today = \Carbon\Carbon::now()->toDateString();
    $selectedDate = $request->input('selected_date', Carbon::now()->toDateString());
    $selectedDateStart = Carbon::parse($selectedDate)->startOfDay();
    $selectedDateEnd = Carbon::parse($selectedDate)->endOfDay();

    $hossasOnSelectedDate = $person->hossas->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    return view('hossaedit', compact('person', 'selectedDate', 'hossasOnSelectedDate'));
}

public function change(Request $request, $people_id, $id)
    {
        $person = Person::findOrFail($people_id);
        $hossa = Hossa::findOrFail($id);
        return view('hossachange', compact('person', 'hossa'));
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
    // バリデーションルールとメッセージを定義
    $rules = [
        'created_at' => 'required', // 日時の登録を必須にする
        'filename' => 'mimes:mp4,mov,x-ms-wmv,mpeg,avi|max:2048', // 2MB = 2048KB
    ];
    $messages = [
        'created_at.required' => '時間の登録は必須です。',
        'filename.max' => 'ファイルサイズが大きすぎます。2MB以下のファイルを選択してください。',
        'uploaded' => 'ファイルサイズが大きすぎます。2MB以下のファイルを選択してください。',
        'mimes' => '動画ファイルを選択してください。（動画ファイルはmp4,mov,x-ms-wmv,mpeg,aviのいずれかのタイプにしてください）',
    ];

    // バリデーション実行
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // データ更新
    $hossa = Hossa::find($request->id);

    if ($request->hasFile('filename')) {
        $directory = 'public/sample/hossa_photo';
        $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
        $request->file('filename')->storeAs($directory, $filename);
        $filepath = $directory . '/' . $filename;

        // 更新されたファイル名とパスをセット
        $hossa->filename = $filename;
        $hossa->path = $filepath;
    }

    // 他のデータを更新
    $hossa->fill($request->except(['filename']));
    $hossa->save();

    // セッショントークンを再生成
    $request->session()->regenerateToken();

    $people = Person::all();

    return view('people', compact('hossa', 'people'));
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hossa = Hossa::find($id);
    if ($hossa) {
        $hossa->delete();
    }
        return redirect()->route('people.index');
    }
}
