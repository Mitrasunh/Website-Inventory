<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetRequest extends FormRequest
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
            'txtidAsset' => 'required',
            'txtname' => 'required',
        ];
    }

    public function messages(): array
    {
        return[
            'txtname.required' => 'silahkan isi :attribute',
            'txtserialNumber' => ':attribute tidak boleh kosong'
        ];
    }

    public function attributes(): array
    {
        return [
            'txtname' => 'Name',
            'txtserialNumber' => 'Serial Number',
        ];
    }
}
