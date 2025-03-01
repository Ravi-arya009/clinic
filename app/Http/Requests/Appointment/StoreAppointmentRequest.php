<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'dob' => 'nullable|date',
            'gender' => 'nullable|digits_between:1,2',
        ];

        if (auth()->guard('patients')->check()) {
            $patientId = auth()->guard('patients')->id();
            $rules['phone'] = "required|digits_between:10,13|unique:patients,phone,{$patientId}";
            $rules['whatsapp'] = "nullable|digits_between:10,13|unique:patients,whatsapp,{$patientId}";
        } else {
            $rules['phone'] = 'required|digits_between:10,13|unique:patients,phone';
            $rules['whatsapp'] = 'nullable|digits_between:10,13|unique:patients,whatsapp';
            $rules['password'] = 'required|min:4|confirmed';
        }

        if ($this->input('booking_for') == '2') {
            $rules = array_merge($rules, $this->getDependentRules($rules));
        }

        return $rules;
    }

    private function getDependentRules(array $rules): array
    {
        return [
            'dependent_name' => 'required|string|max:255',
            'dependent_phone' => 'required|digits_between:10,13|unique:dependents,phone',
            'dependent_whatsapp' => 'digits_between:10,13|unique:dependents,whatsapp',
            'dependent_email' => 'email',
            'dependent_dob' => 'date',
            'dependent_gender' => 'digits_between:1,2',
            'dependent_relation' => 'required|in:' . implode(',', array_keys(config('relations'))),
        ];
    }
}
