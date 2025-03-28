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

        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:clinics,slug,' . $clinicId, // Ensures uniqueness while updating
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', // extra slug specific rules
            ],
            'phone' => 'nullable|digits_between:10,13|unique:clinics,phone,' . $clinicId,
            'whatsapp' => 'nullable|digits_between:10,13|unique:clinics,whatsapp,' . $clinicId,
            'email' => 'nullable|email',
            'state' => 'nullable|exists:states,id',
            'city' => 'nullable|exists:cities,id',
            'address' => 'nullable|string',
            'pincode' => 'nullable|string|max:8',
            'area' => 'nullable|string|max:255',
            'speciality' => 'nullable|exists:specialities,id',
            'contact_person' => 'nullable|string|max:255',
            'contact_person_phone' => 'nullable|digits_between:10,13',
            'contact_person_whatsapp' => 'nullable|digits_between:10,13',
            'contact_person_email' => 'nullable|email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',

            'clinic_working_hours' => 'json',
            'clinic_working_hours.*.day' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'clinic_working_hours.*.shift' => 'in:Morning,Afternoon,Evening,Night',
            'clinic_working_hours.*.opening_time' => 'date_format:H:i A',
            'clinic_working_hours.*.closing_time' => 'date_format:H:i A|after:opening_time',
        ];
    }

    public function messages(): array
    {
        return [
            'slug.*' => 'Invalid slug.',
            'phone.*' => 'Invalid phone number.',
            'whatsapp.*' => 'Invalid whatsapp number.',
            'admin_phone.*' => 'Invalid admin phone number.',
            'contact_person_phone.*' => 'Invalid phone number.',
            'contact_person_whatsapp.*' => 'Invalid whatsapp number.',
            'email.*' => 'Invalid email.',
            'contact_person_email.*' => 'Invalid email.',
            'logo.*' => 'Invalid logo.',
        ];
    }
}
