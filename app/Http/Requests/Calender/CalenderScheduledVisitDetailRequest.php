<?php

namespace App\Http\Requests\Calender;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Enums\RoleType as RoleEnum;
use Illuminate\Support\Facades\Auth;

class CalenderScheduledVisitDetailRequest extends FormRequest
{
    // 本来は権限バリデーションも入れたい
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
        return [
            'scheduled_visit_id' => ['required', 'integer'],
        ];
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
        $array = $request->only([
            'scheduled_visit_id',
        ]);

        return $array;
    }
}
