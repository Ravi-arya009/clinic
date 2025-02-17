<?php

namespace App\Services;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserService
{
    protected $clinicId;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function storeClinicAdmin($name, $phone, $clinicId)
    {
        try {
            return User::create([
                'id' => Str::uuid(),
                'name' => $name,
                'phone' => $phone,
                'password' => Hash::make('ravi'),
                'role_id' => config('role.admin'),
                'clinic_id' => $clinicId
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateClinicAdmin($adminId, $adminName, $adminPhone)
    {
        try {
            $clinicAdmin = User::findorFail($adminId);
            $clinicAdmin->name = $adminName;
            $clinicAdmin->phone = $adminPhone;
            $clinicAdmin->save();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function storeUser($data)
    {
        try {
            $user = User::create([
                'id' => Str::uuid(),
                'name' => $data['name'],
                'phone' => $data['phone'],
                'whatsapp' => $data['whatsapp'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'role_id' => $data['role'],
                'state_id' => $data['state'],
                'city_id' => $data['city'],
                'area' => $data['area'],
                'pincode' => $data['pincode'],
                'address' => $data['address'],
                'clinic_id' => $this->clinicId,
                'password' => Hash::make('ravi'),
            ]);

            if ($user->role_id == config('role.doctor')) {
                $this->storeDoctorProfile($data, $user->id);
            }
            return [
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while creating user'
            ];
        }
    }

    public function storeDoctorProfile($data, $userId)
    {
        try {
            $doctorProfile = Doctor::create([
                'user_id' => $userId,
                'speciality_id' => $data['speciality'],
                'qualification_id' => $data['qualification'],
                'consultation_fee' => $data['consultation_fee']
            ]);

            return [
                'success' => true,
                'message' => 'Doctor profile created successfully',
                'data' => $doctorProfile
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while doctor profile'
            ];
        }
    }

    public function storePatient($data)
    {
        try {
            $patient = Patient::create([
                'id' => Str::uuid(),
                'name' => $data['name'],
                'phone' => $data['phone'],
                'whatsapp' => $data['whatsapp'],
                'email' => $data['email'],
                'state_id' => $data['state'],
                'city_id' => $data['city'],
                'address' => $data['address'],
                'area' => $data['area'],
                'pincode' => $data['pincode'],
                'gender' => $data['gender'],
                'password' => Hash::make('ravi'),
            ]);

            return [
                'success' => true,
                'message' => 'Patient created successfully',
                'data' => $patient
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while creating Patient'
            ];
        }
    }

    public function getUsersByClinicId($clinicId)
    {
        try {
            $users = User::orderBy('created_at', 'asc')->where('clinic_id', $clinicId)->get();
            return $users;
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while fetching users'
            ];
        }
    }

    public function getUsersByClinicIdAndRoleId($clinicId, $roleId)
    {
        try {
            $users = User::where('role_id', $roleId)
                ->where('clinic_id', $clinicId)
                ->orderBy('created_at', 'asc')
                ->get();
            return [
                'success' => true,
                'message' => 'Users fetched successfully',
                'data' => $users
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while fetching users'
            ];
        }
    }
}
