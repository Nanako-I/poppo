<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        // $validated = $request->validateWithBag('updatePassword', [
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            // 'password' => ['required', Password::defaults(), 'confirmed'],
            'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/' // '大文字小文字英数字含む,
        ],
        ]);
        
        // 現在のパスワードが一致するかチェック
        if (!Hash::check($validated['current_password'], $request->user()->password)) {
            // 現在のパスワードが正しいかチェック
        // if (!Hash::check($value, auth()->user()->password)) {
        dd($validated['current_password'], $request->user()->password);
        return back()->withErrors([
            'current_password' => __('現在のパスワードが正しくありません。'),
        ], 'updatePassword');
    }


        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
