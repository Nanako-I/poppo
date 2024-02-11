<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {// 新着順にメッセージ一覧を取得

    return \App\Message::orderBy('id', 'desc')->get();

}

public function create(Request $request) { // メッセージを登録

    \App\Message::create([
        'body' => $request->message
    ]);

}
}
