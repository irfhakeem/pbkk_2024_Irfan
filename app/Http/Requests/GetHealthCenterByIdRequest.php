<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetHealthCenterByIdRequest extends FormRequest
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
            //
            "health_center_id" => ["required", "numeric"],
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new (response()->json(
            [
                "error" => $validator->errors(),
                "messege" => "Please check your input",
            ],
            412
        ));
    }
}
