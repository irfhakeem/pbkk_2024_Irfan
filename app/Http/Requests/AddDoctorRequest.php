<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDoctorRequest extends FormRequest
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
            'sip' => ['required', 'numeric', 'digits:9', 'unique:doctors,sip'], // Menggunakan digits:9
            'nama' => 'required|string',
            'email' => 'required|string|unique:users,email', // Pastikan email unik di tabel users
            'no_hp' => 'required|string',
            'jenis_kelamin' => ['required', 'in:L,P'], // Menggunakan array dan aturan in yang benar
            'spesialis_id' => 'required|exists:specializations,spesialis_id', // Pastikan spesialis_id ada di tabel spesialis
            'tanggal_lahir' => 'required|date',
            'health_center_id' => 'required|exists:health_centers,health_center_id', // Pastikan health_center_id ada di tabel health_centers
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
