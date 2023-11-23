<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TicketRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'memberId' => 'required',
            'ticketId' => 'required',
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
