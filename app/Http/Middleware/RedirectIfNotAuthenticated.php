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
        
        
        // ログインしていない場合
        if (!Auth::check()) {
            // リクエストが login, registerなどの ルートの場合はリダイレクトしない
            if (!$request->is('login') && !$request->is('register') && !$request->is('forgot-password') && !$request->is('before-login') && !$request->is('passcodeform')&& !$request->is('preregistrationmail')&& !$request->is('send-passcode')&& !$request->is('hogoshalogin')&& !$request->is('hogosharegister')&& !$request->is('hogoshanumber')&& !$request->is('staffregister')&& !$request->is('reset-password/*')) {
                return redirect()->route('before-login');
            }
        }

        // return $next($request);
        $response = $next($request);
        // Ensure the response is of the correct type
        if (!$response instanceof \Symfony\Component\HttpFoundation\Response) {
        $response = response($response);
        }
        return $response;
            }
}