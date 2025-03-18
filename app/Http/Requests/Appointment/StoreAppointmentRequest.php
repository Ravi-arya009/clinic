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
            $rules = array_merge($rules, $this->getdependantRules($rules));
        }

        return $rules;
    }

    private function getdependantRules(array $rules): array
    {
        return [
            'dependant_name' => 'required|string|max:255',
            'dependant_phone' => 'nullable|digits_between:10,13|unique:dependants,phone',
            'dependant_whatsapp' => 'nullable|digits_between:10,13|unique:dependants,whatsapp',
            'dependant_email' => 'nullable|email',
            'dependant_dob' => 'nullable|date',
            'dependant_gender' => 'nullable|digits_between:1,2',
            'dependant_relation' => 'required|in:' . implode(',', array_keys(config('relations'))),
        ];
    }
}
