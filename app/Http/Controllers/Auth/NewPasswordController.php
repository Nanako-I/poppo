<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    
    
    // 通常のパスワードリセットビュー
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    // スタッフ用のパスワードリセットビュー
    public function createStaff(Request $request): View
    {
        return view('auth.reset-password-staff', ['request' => $request]);
    }
    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/' // '大文字小文字英数字含む,
        ],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60), //remember_tokenをランダムに生成し設定する
                ])->save();

                event(new PasswordReset($user));
            }
        );

       
        if ($status == Password::PASSWORD_RESET) {
        return redirect()->route('hogoshalogin')->with('status', __($status));
    }
    
    $errorMessage = $status == Password::INVALID_TOKEN ? __('このURLは期限切れです。') : __($status);
    
    return back()->withInput($request->only('email'))
                 ->withErrors(['email' => $errorMessage]);
    }
    
    public function staffpasswordstore(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['nullable', 'email'],
            'custom_id' => ['required', 'string'],
            'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/' // '大文字小文字英数字含む,
        ],
        ]);
    // パスワードリセットメールが届いたメールアドレスからユーザーIDを取得
    $email = $request->input('email');
    // dd($email);
    $userId = DB::table('users')->where('email', $email)->value('id');
// dd($userId); // 取れている
    if (!$userId) {
        // ユーザーが見つからない場合のエラー処理
        return back()->withInput($request->only('email'))
                     ->withErrors(['email' => __('指定されたメールアドレスのユーザーが見つかりません。')]);
    }

    // facility_staffsテーブルから user_id が取得したユーザーIDに一致する facility_id を取得
    $facilityId = DB::table('facility_staffs')->where('user_id', $userId)->value('facility_id');
    // dd($facilityId);// 取れている
    if (!$facilityId) {
        // facility_idが見つからない場合のエラー処理
        return back()->withErrors(['email' => __('施設情報が見つかりません。')]);
    }
    
    // custom_idを持つユーザーを取得
    $customIdUser = User::where('custom_id', $request->custom_id)->first();
    // dd($customIdUser);// 取れている
    if (!$customIdUser) {
        return back()->withInput($request->only('custom_id'))
                     ->withErrors(['custom_id' => __('指定されたIDのユーザーが見つかりません。')]);
    }

    // custom_idのユーザーが同じfacility_idを持っているか確認
    $customIdUserFacilityId = DB::table('facility_staffs')->where('user_id', $customIdUser->id)->value('facility_id');
    // dd($customIdUserFacilityId);// 取れている
    if ($customIdUserFacilityId !== $facilityId) {
        return back()->withInput($request->only('custom_id'))
                     ->withErrors(['custom_id' => __('このIDのユーザーの施設が見つかりません。')]);
    }

    $resetRecord = DB::table('password_resets')
                    ->where('email', $email)
                    ->first();

    if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {
        return back()->withInput($request->only('custom_id'))
                     ->withErrors(['custom_id' => __('このURLは期限切れです。')]);
    }

    $customIdUser->forceFill([
        'password' => Hash::make($request->password),
        'remember_token' => Str::random(60),
    ])->save();

    event(new PasswordReset($customIdUser));

    return redirect()->route('login')->with('status', __('パスワードがリセットされました。'));
}
}

