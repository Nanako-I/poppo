<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if (!Auth::check() && !$request->is('login')) {
        //     return redirect()->route('login');
        // }
        
        // ログインしていない場合
        if (!Auth::check()) {
            // リクエストが login, register, forgot-password ルートの場合はリダイレクトしない
            if (!$request->is('login') && !$request->is('register') && !$request->is('forgot-password')) {
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}