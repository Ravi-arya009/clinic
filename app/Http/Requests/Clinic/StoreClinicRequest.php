<?php

namespace App\Http\Requests\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class StoreClinicRequest extends FormRequest
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
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:clinics,slug,',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', // extra slug specific rules
            ],
            'state' => 'nullable|exists:states,id',
            'city' => 'nullable|exists:cities,id',
            'address' => 'nullable',
            'speciality' => 'nullable|exists:specialities,id',
            'area' => 'nullable|string|max:255',
            'phone' => 'nullable|digits_between:10,13|unique:clinics,phone',
            'contact_person' => 'nullable|string|max:255',
            'contact_person_phone' => 'nullable|digits_between:10,13|unique:clinics,contact_person_phone',
            'admin_name' => 'required|string|max:255',
            'admin_phone' => 'required|digits_between:10,13|unique:users,phone',
        ];
    }
}
