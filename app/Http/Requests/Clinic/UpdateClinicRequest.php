<?php

namespace App\Http\Requests\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClinicRequest extends FormRequest
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
        $clinicId = $this->clinicId;
        $adminId = $this->admin_id;

        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:clinics,slug,' . $clinicId, // Ensures uniqueness while updating
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', // extra slug specific rules
            ],
            'city' => 'exists:cities,id',
            'state' => 'exists:states,id',
            'address' => 'nullable',
            'speciality' => 'exists:specialities,id',
            'area' => 'nullable|string|max:255',
            'phone' => 'nullable|digits_between:10,13|unique:clinics,phone,' . $clinicId,
            'contact_person' => 'nullable|string|max:255',
            'contact_person_phone' => 'nullable|digits_between:10,13|unique:clinics,contact_person_phone,' . $clinicId,
            'admin_id' => 'required|exists:users,id',
            'admin_name' => 'required|string|max:255',
            'admin_phone' => 'required|digits_between:10,13|unique:users,phone,' . $adminId,
        ];
    }
}
