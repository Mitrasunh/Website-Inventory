<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'txtnik' => 'required|unique:employees,nik|max:20',
            'txtusername' => 'required',
            'txtemail' => 'required|unique:employees,email',
        ];
    }

    public function messages(): array
    {
        return[
            'txtnik.required' => ':attribute tidak boleh kosong',
            'txtnik.unique' => ':attribute sudah terdaftar',
            'txtname.required' => ':attribute tidak boleh kosong',
            'txtemail.required' => ':attribute tidak boleh kosong',
            'txtemail.unique' => ':attribute sudah terdaftar',
        ];
    }

    public function attributes(): array
{
    return [
        'txtemail' => 'Email',
        'txtnik' => 'NIK',
        'txtusername' => 'Name'
    ];
}
}
