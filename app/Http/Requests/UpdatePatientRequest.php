<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            "patient_id" => ["required", "numeric"],
            "name" => ["required", "string"],
            "email" => ["required", "email"],
            "no_hp" => ["required", "string"],
            "jenis_kelamin" => ["required", "string"],
            "Golongan_darah" => ["required", "string"],
            "tanggal_lahir" => ["required", "date"],
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new (response()->json([
            "error" => $validator->errors(),
            "messege" => "Please check your input"
        ], 422));
    }
}
