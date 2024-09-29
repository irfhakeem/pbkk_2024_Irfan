<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddDrugRequest extends FormRequest
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
            'nama' => ['required', 'string', 'max:100', 'min:3'],
            'jenis' => ['required', 'string', 'max:100', "in:Tablet,Cair,Kapsul,Salep"],
            'satuan' => ['required', 'string', 'max:100', "in:mg,ml,gram"],
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors(),
            'messege' => 'The given data was invalid'
        ], 422));
    }
}
