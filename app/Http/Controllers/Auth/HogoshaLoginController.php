<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\HogoshaLoginRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HogoshaLoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('hogoshalogin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(HogoshaLoginRequest $request): RedirectResponse
    {
       
        $request->authenticate();

        $request->session()->regenerate();

        // ログインしている人の情報を取得
        $user = Auth::user();
        
        // ロールIDが '5' または '6' の役割を持っているか確認
        $user_roles = $user->roles()->whereIn('role_id', ['5', '6'])->get();
    
        if ($user_roles->isNotEmpty()) {
            return redirect(RouteServiceProvider::HOMEFAMILY);
        }
    
            // 上記のいずれの条件にも該当しない場合のデフォルトのリダイレクト
            return redirect()->route('hogoshalogin')->with('error', 'ご家族の方以外はこちらのフォームからログインできません。');
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