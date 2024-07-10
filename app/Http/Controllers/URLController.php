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



// public function unsubscribe(Request $request, $signedUrl)
// {
//     if ($request->hasValidSignature()) {
//         abort(403, 'このURLは有効期限切れです。施設管理者に招待URLの再送を依頼してください。');
//     }
//     return view('preregistrationmail');

   
// }
    
}