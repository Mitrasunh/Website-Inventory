<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
            'txtusername' => 'required',
            'txtemail' => [
                'required',
                'email',
                Rule::unique('employees', 'email')->ignore($this->txtnik, 'nik'),                
            ],
        ];
    }
    public function messages(): array
    {
        return[
            'txtusername.required' => ':attribute tidak boleh kosong',
            'txtemail' => ':attribute sudah terdaftar'
        ];
    }

    public function attributes(): array
{
    return [
        'txtusername' => 'Name',
        'txtemail' => 'Email'
    ];
}
}
