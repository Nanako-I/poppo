<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use App\Models\Kyuuin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
         //   画像保存
        $directory = 'public/sample/kyuuin_photo';
        $filename = null;
        $filepath = null;
    
        if ($request->hasFile('filename')) {
            $request->validate([
                'filename' => 'image|max:2048',
            ]);
            $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
            $filename = $request->file('filename')->getClientOriginalName();	
            $request->file('filename')->storeAs($directory, $filename);
            $filepath = $directory . '/' . $filename;
        }
    
        // バリデーションした内容を保存する↓
        
        $kyuuin = Kyuuin::create([
        'people_id' => $request->people_id,
        'kyuuin' => $request->kyuuin,
        'bikou' => $request->bikou,
        'created_at' => $request->created_at,
        'updated_at' => $request->updated_at,
        'filename' => $filename,
        // ファイル名は $filename という変数に保存されているので、それを利用して filename カラムに保存する
        'path' => $filepath,
        
    ]);

     $people = Person::all();
     $request->session()->regenerateToken();
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
    $today = \Carbon\Carbon::now()->toDateString();
    $selectedDate = $request->input('selected_date', Carbon::now()->toDateString());
    $selectedDateStart = Carbon::parse($selectedDate)->startOfDay();
    $selectedDateEnd = Carbon::parse($selectedDate)->endOfDay();

    $kyuuinsOnSelectedDate = $person->kyuuins->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    return view('kyuuinedit', compact('person', 'selectedDate', 'kyuuinsOnSelectedDate'));
}

public function change(Request $request, $people_id, $id)
    {
        $person = Person::findOrFail($people_id);
        $kyuuin = Kyuuin::findOrFail($id);
        return view('kyuuinchange', compact('person', 'kyuuin'));
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
        $kyuuin = Kyuuin::find($request->id);
        $form = $request->all();
        $kyuuin->fill($form)->save();
    
        $request->session()->regenerateToken();
    
        $people = Person::all();
        // 二重送信防止
        $request->session()->regenerateToken();
        return view('people', compact('kyuuin', 'people'));
    }
//     public function update(Request $request, Kyuuin $kyuuin)
//     {
//     //データ更新
//         $kyuuin = Kyuuin::find($request->id);
//         // 画像がアップロードされているかチェック
//         if ($request->hasFile('filename')) {
//             $request->validate([
//                 'filename' => 'image|max:2048', // ファイルのバリデーション
//             ]);
    
//             $directory = 'public/sample/kyuuin_photo';
//             $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
//             $request->file('filename')->storeAs($directory, $filename);
//             $filepath = $directory . '/' . $filename;
    
//             // 更新されたファイル名とパスをセット
//             $kyuuin->filename = $filename;
//             $kyuuin->path = $filepath;
            
//     }
//         // 他のデータを更新
//     $kyuuin->fill($request->except(['filename', '_token', 'path']));
//     $kyuuin->save();

//     // セッショントークンを再生成
//     $request->session()->regenerateToken();

//     $people = Person::all();

//     return view('people', compact('kyuuin', 'people'));
// }


    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kyuuin = Kyuuin::find($id);
    if ($kyuuin) {
        $kyuuin->delete();
    }
        return redirect()->route('people.index');
    }
}
