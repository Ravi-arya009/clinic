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
        return [
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
            'role' => 'required|in:' . implode(',', config('role')),
            //nedd a image validation for profile picture (later, when implementing it)
            'speciality' => $this->role == config('role.doctor') ? 'required|exists:specialities,id' : 'sometimes',
            'qualification' => $this->role == config('role.doctor') ? 'required|exists:qualifications,id' : 'sometimes',
            'consultation_fee' => $this->role == config('role.doctor') ? 'required|numeric' : 'sometimes',
        ];
    }
}
