<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetRequest extends FormRequest
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
            'txtidAsset' => 'required|unique:assets,idAsset|max:20',
            'txtname' => 'required',
            'txttype' => 'required',
            'txtserialNumber' => 'required',
        ];
    }

    public function messages(): array
    {
        return[
            'txtidAsset.required' => ':attribute tidak boleh kosong',
            'txtidAsset.unique' => ':attribute sudah terdaftar',
            'txtname.required' => ':attribute tidak boleh kosong',
            'txttype.required' => ':attribute tidak boleh kosong',
            'txtserialNumber.required' => ':attribute tidak boleh kosong',
        ];
    }

    public function attributes(): array
{
    return [
        'txtidAsset' => 'ID',
        'txtname' => 'Name',
        'txttype' => 'Type',
        'txtserialNumber' => 'Serial Number',
    ];
}
}
