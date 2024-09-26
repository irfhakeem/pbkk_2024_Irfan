<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMedicalReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'judul' => 'required',
            'patient_id' => 'required',
            'dokter' => 'required|exists:doctors,nama',
            'faskes' => 'required|exists:health_centers,nama',
            'service' => 'required|exists:services,nama',
            'diagnosis' => 'required',
            'date' => 'required',
            'status' => 'required|in:Selesai,Belum Selesai',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'message' => 'The given data was invalid.'
        ], 422));
    }
}
