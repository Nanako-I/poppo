<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // return route('login');
            return route('before-login');
        }
      
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        // if (! $request->user()) {
        //     return redirect()->route('login'); // ログイン画面にリダイレクト
        // }
        if (! $request->route()->named('hogosharegister') || $request->user()) {
            return parent::handle($request, $next, $guards);
        }


        return $next($request);
    }
}
