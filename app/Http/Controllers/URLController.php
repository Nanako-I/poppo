<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Http\Request;

class URLController extends Controller
{
    
    public function sendInvitation()
{
//   return URL::temporarySignedRoute(
//     'unsubscribe', now()->addMinutes(30), ['user' => 1]
// );
    $url = URL::temporarySignedRoute(
        // return URL::temporarySignedRoute(
        'signed.invitation', 
        now()->addMinutes(30), 
        ['signedUrl' => 'hogosharegister']
    );
    // dd($url);
     $signedUrl = $url;
// dd($signedUrl);
// dd($url);
    return view('invitation', compact('signedUrl', 'url'));
    //  return view('invitation', compact([
    //         'signedUrl',
    //         'url'
        // ]));
}

// sendInvitation メソッドが招待URLを生成↓
// public function sendInvitation()
// {
    
//     $url = URL::temporarySignedRoute(
//         'signed.invitation', 
//         now()->addMinutes(30),
//         ['signedUrl' => 'hogosharegister']
//     );
    // dd($url);

    // signed.invitation ルートにリダイレクトさせ生成されたURLをビューに渡す
    // return view('invitation', ['signedUrl' => $url]);
     


public function generate_temporary_signed_url(Request $request) {
        // サンプルパラメーター
        $user_id = $request->input('user_id');
        // 期限3秒
        $expire = now()->addMilliseconds(3000);
        // 期限あり署名付きURLの生成
        $temporary_signed_url = URL::temporarySignedRoute('unsubscribe', $expire, ['user_id' => $user_id]);
 
        return view('unsubscribe.index',compact([
            'user_id',
            'temporary_signed_url'
        ]));
        
        return URL::temporarySignedRoute(
    'hogosharegister', now()->addMinutes(30), ['user' => 1]
);

    }

public function unsubscribe() {
        // 署名付きURLをクリックして、署名チェックに成功したら、下記画面に遷移。
        return view('hogosharegister');
    }
    
}