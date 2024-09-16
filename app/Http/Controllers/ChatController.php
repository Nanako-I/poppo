<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use App\Models\Chat;
// 追記↓
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//ログイン中のユーザIDを取得する
use App\Events\MessageSent;
use App\Models\Conversation;


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

    //  public function show(Request $request, $conversationId)
    // {
    //     $conversation = Conversation::findOrFail($conversationId);
    //     $chats = $conversation->chats()->orderBy('created_at', 'asc')->get();

    //     return view('chats', compact('conversation', 'chats'));
    // }

     // 新しいメッセージを保存する
    //  public function store(Request $request, $conversationId)
    //  {
    //      $request->validate([
    //          'message' => 'required|string',
    //      ]);

    //      $chat = new Chat();
    //      $chat->conversation_id = $conversationId;
    //      $chat->user_id = auth()->id(); // ログインユーザーのID
    //      $chat->user_name = auth()->user()->name;
    //      $chat->user_identifier = auth()->user()->email; // 例としてメールアドレスを使用
    //      $chat->message = $request->input('message');
    //      $chat->save();

    //      return redirect()->route('chat.show', $conversationId);
    //  }

    public function store(Request $request, $people_id)
    {

        \Log::info('People ID in store method: ' . $people_id);
        try {
            $person = Person::findOrFail($people_id);

            $user = Auth::user();
            if ($user) {
                $user_name = $user->name;
                $user_identifier = $user->id;
            } else {
                $user_name = 'Guest';
                $user_identifier = Str::random(20);
            }

            // ユーザー名と識別子をセッションに登録
            session(['user_name' => $user_name]);
            session(['user_identifier' => $user_identifier]);

            // 画像保存
            $directory = 'public/sample/chat_photo';
            $filename = null;
            $filepath = null;

            if ($request->hasFile('filename')) {
                $request->validate(['filename' => 'image|max:2048']);
                $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
                $request->file('filename')->storeAs($directory, $filename);
                $filepath = $directory . '/' . $filename;
            }

            $chat = Chat::create([
                'people_id' => $people_id,
                'user_name' => $user_name,
                'user_identifier' => $user_identifier,
                'message' => $request->message,
                'filename' => $filename,
                'path' => $filepath,
            ]);

            // イベントをブロードキャスト
          broadcast(new MessageSent($chat))->toOthers();

            // 正常に保存された場合のレスポンス
            return response()->json([
                'message' => $request->message,
                'user_identifier' => $user_identifier,
                'user_name' => $user_name,
                'created_at' => $chat->created_at->format('Y-m-d H:i:s'),
                'filename' => $chat->filename
            ]);

            // return response()->json([
            //     'message' => $request->message,
            //     'user_identifier' => $user->id,
            //     'user_name' => $user->name,
            //     'created_at' => $chat->created_at->format('Y-m-d H:i:s'),
            //     'filename' => $chat->filename
            // ]);
        } catch (\Exception $e) {
            // エラーが発生した場合のレスポンス
            // return response()->json(['error' => 'メッセージの保存に失敗しました。'], 500);
             return response()->json(['error' => $e->getMessage()], 500);

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
    // 現在ログインしているユーザーを取得
    $user = Auth::user();


   // もしログインしているユーザーが存在するかチェックする場合
    if ($user) {
        $user_name = $user->name;
        $user_identifier = $user->id;
    } else {
        // ユーザーが存在しない場合の処理
        $user_name = 'Guest';
        $user_identifier = Str::random(20);
    }
    // ユーザーIDをセッションに登録
    //   $user_identifier = $request->session()->get('user_identifier', Str::random(20));
      session(['user_identifier' => $user_identifier]);
      session(['user_identifier' => $user_identifier]);

    // ユーザー識別子がなければランダムに生成してセッションに登録
    if ($request->session()->missing('user_identifier')) {
        session(['user_identifier' => Str::random(20)]);
    }
       // ユーザー名を変数に登録（デフォルト値：Guest）
  // $user_name = $request->session()->get('user_name', 'Guest');
    //dd($user_name);
    // ユーザー名を変数に登録（デフォルト値：Guest）
    if ($request->session()->missing('user_name')) {
        session(['user_name' => $user_name]);
    }

    // チャット画面を表示する際に、未読メッセージを既読にする
    Chat::where('people_id', $people_id)
        ->where('user_identifier', '!=', $user_identifier)
        ->where('is_read', false)
        ->update(['is_read' => true]);

    // 指定されたpeople_idの未読メッセージの件数を取得
    // $unreadMessages = Chat::where('people_id', $people_id)->where('is_read', false)->count();


   // データベース内の指定されたpeople_idのチャットの件数を取得
    $length = Chat::where('people_id', $people_id)->count();

    // 表示するチャットメッセージの件数を設定
    $display = 5;

    // 指定されたpeople_idの最新の5件のチャットメッセージを取得
    $chats = Chat::where('people_id', $people_id)
                 ->offset($length - $display)
                 ->limit($display)
                 ->get(['*', 'filename', 'path']);

    $unreadMessages = Chat::where('people_id', $people_id)
    ->where('is_read', false)
    ->count();

    // ビューにデータを渡して表示
    return view('chat', ['id' => $person->id], compact('person', 'user_name', 'chats', 'unreadMessages'));
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