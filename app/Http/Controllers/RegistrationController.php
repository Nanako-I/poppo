<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Passcode;
use App\Mail\PasscodeMail;


class RegistrationController extends Controller
{
    public function sendPasscode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $passcode = Str::random(6); // ランダムな6桁のパスコードを生成
        $expiresAt = Carbon::now()->addMinutes(10); // 10分後に期限切れ

        // パスコードをデータベースに保存
        Passcode::create([
            'email' => $email,
            'passcode' => $passcode,
            'expires_at' => $expiresAt,
        ]);
        
        // セッションにメールアドレスを保存
    $request->session()->put('email', $email);
        // session(['email' => $email]);
        // $emailsession = $request->session()->get('email');

        // パスコードをメールで送信
        Mail::to($email)->send(new PasscodeMail($passcode));

        // return response()->json(['message' => 'パスコードが送信されました。']);
        // return redirect()->route('passcodeform');
        // JSONレスポンスでリダイレクトURLを返す
        return response()->json(['redirect' => route('passcodeform')]);
    }
    
    public function showPasscodeForm()
    {
        // return view('passcode-form');
    }
    
    public function validatePasscode(Request $request)
    {
        $request->validate([
            'passcode' => 'required|string|size:6',
        ]);

        $passcode = $request->input('passcode');
        // $email = session('email');
        $email = $request->session()->get('email'); // セッションからメールアドレスを取得
        
        // dd($email);
        $passcodeRecord = Passcode::where('email', $email)
            ->where('passcode', $passcode)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($passcodeRecord) {
            // return redirect()->route('hogosharegister');
            return view('hogosharegister'); 
        } else {
            return back()->withErrors(['passcode' => 'パスコードが一致しません。'])->withInput();
        }
    }
    
    public function showHogoshaRegisterForm()	
    {	
    return view('hogosha.register'); // 適切なビューを返す	
    }
}