<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
       
        $request->authenticate();

        $request->session()->regenerate();

        // ログインしている人の情報を取得
        $user = Auth::user();
        
        // ロールIDが '5' または '6' の役割を持っているか確認
        $user_roles = $user->roles()->whereIn('role_id', ['1', '2', '3', '4'])->get();
    
        if ($user_roles->isNotEmpty()) {
            return redirect(RouteServiceProvider::HOME);
        }
    
            // 上記のいずれの条件にも該当しない場合のデフォルトのリダイレクト
            return redirect()->route('login')->with('error', '職員の方以外はこちらのフォームからログインできません。');
        }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/before-login');
    }
}