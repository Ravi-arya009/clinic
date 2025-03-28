<?php

namespace App\Http\Requests\Patients;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,13|unique:patients,phone',
            'password' => 'required|min:4|confirmed',
        ];
    }
    public function messages(): array
    {
        return [
            'phone.unique' => 'Phone number already taken.',
            'phone.*' => 'Invalid phone number.',
        ];
    }
}
