<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEducationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ["required", "string", Rule::unique("education", "name")],
            'phone_number' => ["required", "string", "unique:education,phone_number"],
            'website' => ["string"],
            'instagram' => ["string"],
            'telegram' => ["string"],
            'youtube' => ["string"],
            'facebook' => ["string"],
            'bio' => ["string"],
            'certificate' => ["string"],
            'logo' => ["string"],
            'location' => ["string"],
            'address' => ["string"],
            "category_id" => ["required", "integer", "exists:categories,id"],
            "district_id" => ["required", "integer", "exists:districts,id"],
            "user_id" => ["required", "integer", "exists:users,id", "unique:education,user_id"],
        ];
    }
}
