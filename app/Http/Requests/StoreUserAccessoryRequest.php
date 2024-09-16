<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserAccessoryRequest extends FormRequest
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
            'txtnik' => 'required|exists:employees,nik',
            'txtmodelNumber' => 'required|array',
            'txtmodelNumber.*' => 'exists:accessories,modelNumber',
            'txtstartDate' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'txtnik.required' => 'The employee field is required.',
            'txtnik.exists' => 'The selected employee is invalid.',

            'txtmodelNumber.required' => 'At least one accessory must be selected.',
            'txtmodelNumber.array' => 'Invalid data for accessories.',

            'txtmodelNumber.*.exists' => 'One or more selected accessories are invalid.',

            'txtstartDate.required' => 'The start date field is required.',
            'txtstartDate.date' => 'Invalid date format for the start date.',
        ];
    }
}
