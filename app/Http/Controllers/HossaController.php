<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use App\Models\Hossa;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
         //   画像保存
        $directory = 'public/sample/hossa_photo';
        $filename = null;
        $filepath = null;
    
        if ($request->hasFile('filename')) {
            $request->validate([
                'filename' => 'mimes:mp4,mov,x-ms-wmv,mpeg,avi|max:2000000',
            ]);
            
            // ファイルサイズを取得
        $fileSize = $request->file('filename')->getSize();
        dd($fileSize);
        // 制限サイズを定義（2MB）
        $maxSize = 2000000;
        
        // ファイルサイズが制限を超える場合
        if ($fileSize > $maxSize) {
            return back()->with('error', 'ファイルサイズが大きすぎます。2MB以下のファイルを選択してください。');
        }
        
            $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
            
            $filename = $request->file('filename')->getClientOriginalName();	
            $request->file('filename')->storeAs($directory, $filename);
            $filepath = $directory . '/' . $filename;
        }
        
    
        // バリデーションした内容を保存する↓
        
        $hossa = Hossa::create([
        'people_id' => $request->people_id,
        'user_id_hossa' => $request->user_id_hossa,
        'created_at' => $request->created_at,
        'hossa' => $request->hossa,
        'hossa_bikou' => $request->hossa_bikou,
        'filename' => $filename,
        // ファイル名は $filename という変数に保存されているので、それを利用して filename カラムに保存する
        'path' => $filepath,
        
    ]);
    // dd($hossa);
     $people = Person::all();
     $request->session()->regenerateToken();
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
      
    //データ更新
        $hossa = Hossa::find($request->id);
        // 画像がアップロードされているかチェック
        if ($request->hasFile('filename')) {
            $request->validate([
               'filename' => 'mimes:mp4,mov,x-ms-wmv,mpeg,avi|max:1000000', // ファイルのバリデーション
            ]);
    
            $directory = 'public/sample/hossa_photo';
            $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
            $filename = $request->file('filename')->getClientOriginalName();
            $request->file('filename')->storeAs($directory, $filename);
            $filepath = $directory . '/' . $filename;
    
            // 更新されたファイル名とパスをセット
            $hossa->filename = $filename;
            $hossa->path = $filepath;
            // dd($kyuuin);
            // ↑ここでは$filename　$filepathどちらも取れている
            
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
