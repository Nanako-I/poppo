<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class ValidationSignatureRedirect
{
    // 署名つきURLの認証のために作ったが結局このファイルは使っていません
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasValidSignature()) {
            return $next($request);
        }

        abort(403, 'このURLは有効期限切れです。施設管理者に招待URLの再送を依頼してください。');
    }
}
