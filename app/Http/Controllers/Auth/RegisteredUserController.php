<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'custom_id' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/' // '大文字小文字英数字含む,
        ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'custom_id' => $request->custom_id,
            'password' => Hash::make($request->password),
            // 'custom_id' => Str::random(10), // ランダムな英数字IDを生成
        ]);

        event(new Registered($user));

        Auth::login($user);
        // 職員が新規登録した後の遷移先をFACILITYREGISTER（facilityregister.blade.php）に指定
        return redirect(RouteServiceProvider::FACILITYREGISTER);
    }
}
