<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccessoryRequest extends FormRequest
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
            'txtmodelNumber' => 'required|unique:accessories,modelNumber|max:50',
            'txtcategory' => 'required',
        ];
    }
    public function messages(): array
    {
        return[
            'txtname.required' => ':attribute tidak boleh kosong',
            'txtmodelNumber.required' => ':attribute tidak boleh kosong',
        ];
    }

    public function attributes(): array
{
    return [
        'txtmodelNumber' => 'Model Number',
        'txtname' => 'Name',
        'txtidAcc' => 'ID',
    ];
}
}
