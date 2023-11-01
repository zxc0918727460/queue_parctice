<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ExchangeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'source' => 'required|in:TWD,JPY,USD',
            'target' => 'required|in:TWD,JPY,USD',
            'amount' => [
                'required', 'regex:/^\$\d{1,3}(?:,\d{3})*$/'
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // 取得錯誤資訊
        $responseData = $validator->errors();
        $result = [
            'status_code' => 422,
            'description' => $responseData,
            'server_time' => strtotime('now'),
            'data'        => '',
        ];
        $response = response()->json($result);
        throw new HttpResponseException($response);
    }
}
