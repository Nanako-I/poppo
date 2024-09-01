<?php

namespace App\Http\Controllers;

use App\Models\Toilet;
use App\Models\Person;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


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
          // バリデーションルールとメッセージを定義
    $rules = [
        'created_at' => 'required', // 日時の登録を必須にする
        'filename' => 'image|max:2048', // 2MB = 2048KB
    ];
    $messages = [
        'created_at.required' => '時間の登録は必須です。',
        'image' => '画像ファイルを選択してください。（画像ファイルはjpeg, png, bmp, gif, svgのいずれかにしてください）',
        'uploaded' => '画像ファイルを選択してください。（画像ファイルはjpeg, png, bmp, gif, svgのいずれかにしてください）',
        'filename.max' => 'ファイルサイズが大きすぎます。2MB以下のファイルを選択してください。',
         
    ];
    // バリデーション実行
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
         //   画像保存
        $directory = 'public/sample/toilet_photo';
        $filename = null;
        $filepath = null;
    
        if ($request->hasFile('filename')) {
            $request->validate([
                'filename' => 'image|max:2048',
            ]);
            // $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
            // $filename = $request->file('filename')->getClientOriginalName();	
            
            // 同じファイル名でも上書きされないようユニークなIDをファイル名に追加
            $uniqueId = uniqid();
            $originalFilename = $request->file('filename')->getClientOriginalName();
            $filename = $uniqueId . '_' . $originalFilename;
        
            $request->file('filename')->storeAs($directory, $filename);
            $filepath = $directory . '/' . $filename;
        }
        
        $toilet = Toilet::create([
        'people_id' => $request->people_id,
        
        'urine_amount' => $request->urine_amount,
        'ben_condition' => $request->ben_condition,
        'ben_amount' => $request->ben_amount,
        'bentsuu' => $request->bentsuu,
        'bikou' => $request->bikou,
        'created_at' => $request->created_at,
        'updated_at' => $request->updated_at,
        'filename' => $filename,
        // ファイル名は $filename という変数に保存されているので、それを利用して filename カラムに保存する
        'path' => $filepath,
         
    ]);
    // return redirect('people/{id}/edit');
    $people = Person::all();
    $request->session()->regenerateToken();
    return view('people', compact('toilet', 'people'));
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
    $toilet = $person->toilets;

    $people = Person::all(); // ここで $people を取得
    return view('toilet', ['id' => $person->id],compact('person'));
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

    $toiletsOnSelectedDate = $person->toilets->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    return view('toiletedit', compact('person', 'selectedDate', 'toiletsOnSelectedDate'));
}

public function change(Request $request, $people_id, $id)
    {
        $person = Person::findOrFail($people_id);
        $toilet = Toilet::findOrFail($id);
        return view('toiletchange', compact('person', 'toilet'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Toilet $toilet)
    {
      $rules = [
        'created_at' => 'required', // 日時の登録を必須にする
        'filename' => 'image|max:2048',// 2MB = 2048KB
        ];
        $messages = [
            'created_at.required' => '時間の登録は必須です。',
            'image' => '画像ファイルを選択してください。（画像ファイルはjpeg, png, bmp, gif, svgのいずれかにしてください）',
            'uploaded' => '画像ファイルを選択してください。（画像ファイルはjpeg, png, bmp, gif, svgのいずれかにしてください）',
            'filename.max' => 'ファイルサイズが大きすぎます。2MB以下のファイルを選択してください。',
        ];
        
        // バリデーション実行
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    //データ更新
        $toilet = Toilet::find($request->id);
        // 画像がアップロードされているかチェック
        if ($request->hasFile('filename')) {
            $request->validate([
                'filename' => 'image|max:2048', // ファイルのバリデーション
            ]);
    
            $directory = 'public/sample/toilet_photo';
            // $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
            // $filename = $request->file('filename')->getClientOriginalName();
            
            // 同じファイル名でも上書きされないようユニークなIDをファイル名に追加
            $uniqueId = uniqid();
            $originalFilename = $request->file('filename')->getClientOriginalName();
            $filename = $uniqueId . '_' . $originalFilename;
            
            $request->file('filename')->storeAs($directory, $filename);
            $filepath = $directory . '/' . $filename;
    
            // 更新されたファイル名とパスをセット
            $toilet->filename = $filename;
            $toilet->path = $filepath;
            // dd($kyuuin);
            // ↑ここでは$filename　$filepathどちらも取れている
            
     }
        // 他のデータを更新
    $toilet->fill($request->except(['filename']));
    $toilet->save();

    // セッショントークンを再生成
    $request->session()->regenerateToken();

    $people = Person::all();

    return view('people', compact('toilet', 'people'));
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $toilet = Toilet::find($id);
    if ($toilet) {
        $toilet->delete();
    }
        return redirect()->route('people.index');
    }
}