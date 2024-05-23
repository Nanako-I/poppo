<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\RoleType as RoleEnum;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        // 現在のユーザー情報を取得
        $user = Auth::user();

        // 現在のユーザーがスーパーユーザーであることを確認
        return $user->hasRole(RoleEnum::SuperAdministrator || RoleEnum::FacilityStaffAdministrator || RoleEnum::FacilityStaffUser);
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
        ];
    }
}
