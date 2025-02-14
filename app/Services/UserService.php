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
        // $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function storeClinicAdmin($name, $phone, $clinicId)
    {
        try {
            return User::create([
                'id' => Str::uuid(),
                'name' => $name,
                'phone' => $phone,
                'password' => Hash::make('ravi'),
                'role' => config()->get('role.admin'),
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
                'role' => $data['role'],
                'state_id' => $data['state'],
                'city_id' => $data['city'],
                'area' => $data['area'],
                'pincode' => $data['pincode'],
                'address' => $data['address'],
                'clinic_id' => $this->clinicId,
                'password' => Hash::make('ravi'),
            ]);

            return [
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user
            ];
        } catch (\Exception $e) {
            // return [
            //     'success' => false,
            //     'message' => 'Something went wrong while creating user'
            // ];
            throw $e;
        }
    }

    public function storeDoctor($data)
    {
        DB::beginTransaction();

        try {
            $doctor = User::create([
                'id' => Str::uuid(),
                'name' => $data['name'],
                'phone' => $data['phone'],
                'whatsapp' => $data['whatsapp'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'role' => $data['role'],
                'state_id' => $data['state'],
                'city_id' => $data['city'],
                'area' => $data['area'],
                'pincode' => $data['pincode'],
                'address' => $data['address'],
                'clinic_id' => $this->clinicId,
                'password' => Hash::make('ravi'),
            ]);

            if (!$doctor) {
                return [
                    'success' => false,
                    'message' => 'Failed to create doctor'
                ];
            }

            $doctorProfile = Doctor::create([
                'user_id' => $doctor->id,
                'speciality_id' => $data['speciality'],
                'qualification_id' => $data['qualification'],
                'consultation_fee' => $data['consultation_fee']
            ]);

            if (!$doctorProfile) {
                DB::rollBack();
                return [
                    'success' => false,
                    'message' => 'Failed to create doctor doctor'
                ];
            }

            DB::commit();
            return [
                'success' => true,
                'message' => 'Doctor created successfully',
                'data' => $doctor
            ];
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Log::error('Database error while creating user: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Something went wrong while creating doctor'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error while creating user: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Something went wrong while creating doctor'
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
                'clinic_id' => $this->clinicId,
                'password' => Hash::make('ravi'),
            ]);

            if (!$patient) {
                return [
                    'success' => false,
                    'message' => 'Failed to create patient'
                ];
            }

            return [
                'success' => true,
                'message' => 'Patient created successfully',
                'data' => $patient
            ];
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error while creating patient: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Something went wrong while creating patient'
            ];
        } catch (\Exception $e) {
            Log::error('Error while creating patient: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Something went wrong while creating patient'
            ];
        }
    }
}
