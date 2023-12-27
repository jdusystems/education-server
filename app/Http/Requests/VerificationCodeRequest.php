<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerificationCodeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'The verification code field is required.',
            'code.numeric' => 'The verification code must be numeric.',
        ];
    }
}