<?php

namespace App\Http\Requests\Calender;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Enums\RoleType as RoleEnum;
use Illuminate\Support\Facades\Auth;

class CalenderIndexPersonRequest extends FormRequest
{
    public function authorize()
    {
        // 現在のユーザー情報を取得
        $user = Auth::user();

        return $user->hasRole([
            RoleEnum::SuperAdministrator,
            RoleEnum::FacilityStaffAdministrator,
            RoleEnum::FacilityStaffUser
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Handle a failed validation attempt.
     *
     */
    protected function failedValidation(Validator $validator)
    {
        $res = response()->json([
            'status' => 400,
            'errors' => $validator->errors(),
        ], 400);
        throw new HttpResponseException($res);
    }

    /**
     * リクエスト情報の取得
     *
     * @param  Request
     * @return array
     */
    public static function getOnlyRequest($request)
    {
        return [];
    }
}
