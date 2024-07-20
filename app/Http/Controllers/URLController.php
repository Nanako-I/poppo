<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Http\Request;

class URLController extends Controller
{
    
    public function sendInvitation()
{
    $url = URL::temporarySignedRoute(
        'signed.invitation', 
        now()->addMinutes(30), 
        ['signedUrl' => 'preregistrationmail']
        
    );
    return view('invitation', compact( 'url'));
}

public function staffsendInvitation()
{
    $url = URL::temporarySignedRoute(
        'signed.invitation_staff', 
        now()->addMinutes(30), 
        ['signedUrl' => 'preregistrationmail']
        
    );
    return view('invitation_staff', compact( 'url'));
}
// public function unsubscribe(Request $request, $signedUrl)
// {
//     if ($request->hasValidSignature()) {
//         abort(403, 'このURLは有効期限切れです。施設管理者に招待URLの再送を依頼してください。');
//     }
//     return view('preregistrationmail');

   
// }
//     public function generate_temporary_signed_url(Request $request) {
//         // サンプルパラメーター
//         $user_id = $request->input('user_id');
//         // 期限3秒
//         // $expire = now()->addMilliseconds(3000);
//         $expire = now()->addMinutes(30);
//         // 期限あり署名付きURLの生成
//         $temporary_signed_url = URL::temporarySignedRoute('unsubscribe', $expire, ['user_id' => $user_id]);
 
//         // return view('invitation',compact([
//         //     'user_id',
//         //     'temporary_signed_url'
//         // ]));
        
//         return view('invitation')
//         ->with('user_id', $user_id)
//         ->with('temporary_signed_url', $temporary_signed_url);
// }


}