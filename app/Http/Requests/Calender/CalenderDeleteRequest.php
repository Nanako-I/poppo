<?php

namespace App\Http\Requests\Calender;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

class CalenderDeleteRequest extends FormRequest
{
    // 本来は権限バリデーションも入れたい
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'schedule_id' => ['required', 'integer'],
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
            'schedule_id',
        ]);

        return $array;
    }
}
