<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Enums\RoleType as RoleEnum;

class ProfileUpdateRequest extends FormRequest
{
    
    public function authorize()
    {

        // 現在のユーザー情報を取得
        // $user = Auth::user();

        // return $user->hasRole([
        //     RoleEnum::SuperAdministrator,
        //     RoleEnum::FacilityStaffAdministrator,
        //     RoleEnum::FacilityStaffUser
        // ]);

        // 現在のユーザーが自分自身のプロフィールを更新することを許可
        return true;

    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'password' => [
            // 'required',
             'nullable', // パスワードの更新は任意
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/' // '大文字小文字英数字含む,
        ],
        ];
    }
}
