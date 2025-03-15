<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreDependantRequest extends FormRequest
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
            'dependant_name' => 'required|string|max:255',
            'dependant_phone' => 'required|digits_between:10,13|unique:dependants,phone',
            'dependant_whatsapp' => 'digits_between:10,13|unique:dependants,whatsapp',
            'dependant_email' => 'email',
            'dependant_dob' => 'date',
            'dependant_gender' => 'digits_between:1,2',
            'dependant_relation' => 'required|in:' . implode(',', array_keys(config('relations'))),
        ];
    }
}
