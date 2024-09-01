<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// セッションタイムアウト時にリダイレクトさせる処理↓以下のuse文を追加する。
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;

use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

	// ※ここから記述する※
    // セッションタイムアウト時はログインページにリダイレクトさせる
	public function render($request, Throwable $exception)
{
    if ($exception instanceof TokenMismatchException) {
        // CSRF トークンの不一致が検出された場合の処理
        // セッションをクリアし、ログインページにリダイレクト
        Auth::logout(); // ログアウト
        $request->session()->invalidate(); // セッションを無効化
        // return redirect()->route('before-login'); // ログインページにリダイレクト
        return view('before-login');
    }

    return parent::render($request, $exception);
}
}

