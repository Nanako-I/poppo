<?php

namespace App\Http\Requests\Calender;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

class CalenderRegisterRequest extends FormRequest
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
            'people_id' => ['required', 'integer'],
            'visit_type_id' => ['required', 'integer'],
            'arrival_datetime' => ['required', 'date_format:Y-m-d H:i:s'],
            'exit_datetime' => ['required', 'date_format:Y-m-d H:i:s'],
            'notes' => ['nullable', 'text'],
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
            'people_id',
            'visit_type_id',
            'arrival_datetime',
            'exit_datetime',
            'notes'
        ]);

        return $array;
    }
}
