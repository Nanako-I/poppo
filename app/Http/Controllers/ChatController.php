<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Chat;
// 追記↓
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
   {
        // データーベースの件数を取得
        $length = Chat::all()->count();

        // 表示する件数を代入
        $display = 5;

        $chats = Chat::offset($length-$display)->limit($display)->get();
       return view('chat', ['id' => $person->id],compact('person'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $person = Chat::findOrFail($request->people_id);
   
    return view('people', ['people' => Person::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $people_id)
{
    try {
        $chat = Chat::create([
            'people_id' => $request->people_id,
            'user_name' => $request->user_name,
            
            'user_identifier' => $request->user_identifier,
            'message' => $request->message,
            'medicine' => $request->medicine,
        ]);

        $person = Person::findOrFail($people_id);
        $people = Person::all();
        
        // ユーザー名をフォームから取得してセッションに登録
       session(['user_name' => $request->user_name]);

        return view('chat', compact('chats', 'people', 'person'));
    } catch (\Exception $e) {
        // エラーが発生した場合の処理を行う（例: ログにエラーメッセージを記録）
        \Log::error($e->getMessage());

        // エラーが発生したことをユーザーに通知するなどの処理も追加できます

        // エラーが発生した場合はリダイレクトなど適切な処理を行う
        return redirect()->back()->with('error', 'エラーが発生しました');
    }
}



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $people_id)
{
    $person = Person::findOrFail($people_id);
    $people = Person::all(); // ここで $people を取得
    
    // ユーザーIDをセッションに登録
    //   $user_identifier = $request->session()->get('user_identifier', Str::random(20));
    //   session(['user_identifier' => $user_identifier]);
    
    // ユーザー識別子がなければランダムに生成してセッションに登録
       if($request->session()->missing('user_identifier')){ session(['user_identifier' => Str::random(20)]); }
       
       // ユーザー名を変数に登録（デフォルト値：Guest）
    //   $user_name = $request->session()->get('user_name', 'Guest');
    
    // ユーザー名を変数に登録（デフォルト値：Guest）
       if($request->session()->missing('user_name')){ session(['user_name' => 'Guest']); }
       
    // データーベースの件数を取得
        $length = Chat::all()->count();

        // 表示する件数を代入
        $display = 5;

        $chats = Chat::offset($length-$display)->limit($display)->get();
    

    // return view('chat', ['id' => $person->id, 'chats' => $chats, 'person' => $person , 'user_identifier' => $user_identifier, 'user_name' => $user_name]);
    // return view('chat/index',compact('chats'));
    return view('chat', ['id' => $person->id],compact('person' , 'chats'));
   
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
