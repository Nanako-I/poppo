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

       
        // return $status == Password::PASSWORD_RESET
        //             ? redirect()->route('hogoshalogin')->with('status', __($status))
        //             : back()->withInput($request->only('email'))
        //                     ->withErrors(['email' => __($status)]);
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
            'custom_id' => ['required', 'string'],
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
            $request->only('custom_id', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60), //remember_tokenをランダムに生成し設定する
                ])->save();

                event(new PasswordReset($user));
            }
        );

      
        // return $status == Password::PASSWORD_RESET
        //             ? redirect()->route('login')->with('status', __($status))
        //             : back()->withInput($request->only('custom_id'))
        //                     ->withErrors(['custom_id' => __($status)]);
        if ($status == Password::PASSWORD_RESET) {
        return redirect()->route('login')->with('status', __($status));
    }
    
    $errorMessage = $status == Password::INVALID_TOKEN ? __('このURLは期限切れです。') : __($status);
    
    return back()->withInput($request->only('custom_id'))
                 ->withErrors(['custom_id' => $errorMessage]);
    }
}