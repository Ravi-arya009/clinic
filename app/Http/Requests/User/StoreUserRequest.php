<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'phone' => 'required|digits_between:10,13|unique:users,phone',
            'whatsapp' => 'required|digits_between:10,13|unique:users,whatsapp',
            'email' => 'nullable|email',
            'gender' => 'nullable|digits_between:1,2',
            'dob' => 'nullable|date',
            'state' => 'nullable|exists:states,id',
            'city' => 'nullable|exists:cities,id',
            'address' => 'nullable|string|max:500',
            'pincode' => 'nullable|digits_between:5,10',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required|in:' . implode(',', config('role')),
        ];

        return $this->getRoleSpecificRules($rules);
    }

    private function getRoleSpecificRules(array $rules): array
    {
        switch ($this->input('role')) {
            case config('role.doctor'):
                return array_merge($rules, $this->getDoctorRules());
            default:
                return $rules;
        }
    }

    private function getDoctorRules(): array
    {
        return [
            'speciality' => 'required|exists:specialities,id',
            'qualification' => 'required|exists:qualifications,id',
            'experience' => 'nullable|numeric',
            'consultation_fee' => 'required|numeric',
        ];
    }
}
