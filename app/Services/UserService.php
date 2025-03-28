<?php

namespace App\Services;

use App\Models\ClinicUser;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserService
{
    protected $clinicId;

    public function __construct()
    {
        //turning it off, because service classes should work as apis. and apis do not have their own data. also clinic id is not a function of user instead it's a separate entity.
        // so need to provide clinic id from the controller itself. remove this line completely in future.
        // $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function storeClinicAdmin($name, $phone)
    {
        try {
            $user = User::create([
                'id' => Str::uuid(),
                'name' => $name,
                'phone' => $phone,
                'password' => Hash::make('ravi'),
            ]);

            return $user;
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while creating Clinic Admin'
            ];
        }
    }

    public function assignClinicRoleToUser($userId, $clinicId, $roleId)
    {
        try {
            $response = ClinicUser::create([
                'user_id' => $userId,
                'clinic_id' => $clinicId,
                'role_id' => $roleId
            ]);

            return [
                'success' => true,
                'message' => 'Role assigned successfully',
                'data' => $response
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while assigning role'
            ];
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

    public function storeUser($data, $clinicId)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'id' => Str::uuid(),
                'name' => $data['name'],
                'phone' => $data['phone'],
                'whatsapp' => $data['whatsapp'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'dob' => date('Y-m-d', strtotime($data['dob'])),
                'state_id' => $data['state'],
                'city_id' => $data['city'],
                'address' => $data['address'],
                'pincode' => $data['pincode'],
                'password' => Hash::make('ravi'),
            ]);

            // Handle Profile image file upload and storage
            if (isset($data['profile_picture'])) {
                $profilePicture = $data['profile_picture'];
                $newFileName = $user->id . '.' . $profilePicture->getClientOriginalExtension();
                $profilePicture->storeAs('profile_images', $newFileName, 'public');
                $user->profile_image = $newFileName;
                $user->save();
            }

            if ($data['role'] == config('role.doctor')) {
                $doctorProfileResponse = $this->storeDoctorProfile($data, $user->id);
                $user['doctorProfile'] = $doctorProfileResponse['data'];
                if ($doctorProfileResponse['success'] == false) {
                    DB::rollBack();
                    return [
                        'success' => false,
                        'message' => 'Something went wrong while creating doctor profile'
                    ];
                }
            }

            $clinicUserResponse = $this->assignClinicRoleToUser($user->id, $clinicId, $data['role']);
            $user['clinicUser'] = $clinicUserResponse['data'];

            if ($clinicUserResponse['success'] == false) {
                DB::rollBack();
                return [
                    'success' => false,
                    'message' => 'Something went wrong while creating clinic user'
                ];
            }

            DB::commit();

            return [
                'success' => true,
                'data' => [
                    'user' => $user,
                    'redirectRoute' => route('admin.user.show', $user->id),
                ],
                'message' => 'User created successfully',
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Something went wrong while creating user'
            ];
        }
    }

    public function updateDoctorProfile($data, $doctorId)
    {
        try {
            $doctor = Doctor::where('user_id', $doctorId)->first();
            $doctor->speciality_id = $data['speciality'];
            $doctor->qualification_id = $data['qualification'];
            $doctor->experience = $data['experience'];
            $doctor->consultation_fee = $data['consultation_fee'];
            $doctor->bio = $data['bio'];
            $doctor->save();
            return [
                'success' => true,
                'message' => 'Doctor profile updated successfully',
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while updating doctor profile' . $e
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
                'experience' => $data['experience'],
                'consultation_fee' => $data['consultation_fee'],
                'bio' => $data['bio']
            ]);

            if (!$doctorProfile) {
                return [
                    'success' => false,
                    'message' => 'Something went wrong while creating doctor profile'
                ];
            }

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

        $response = ClinicUser::with('user')->where('clinic_id', $clinicId)->get();

        if (!$response) {
            return [
                'success' => false,
                'message' => 'No Users Found'
            ];
        }
        return $response;
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

    public function storeUserRole($userId, $roleId)
    {
        UserRole::create([
            'user_id' => $userId,
            'role_id' => $roleId
        ]);
    }

    public function updateUser($userId, $data)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($userId);

            $user->update([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'whatsapp' => $data['whatsapp'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'dob' => $data['dob'],
                'state_id' => $data['state'],
                'city_id' => $data['city'],
                'address' => $data['address'],
                'pincode' => $data['pincode'],
            ]);

            if (isset($data['profile_picture'])) {
                $profilePicture = $data['profile_picture'];
                $newFileName = $user->id . '.' . $profilePicture->getClientOriginalExtension();
                $profilePicture->storeAs('profile_images', $newFileName, 'public');
                $user->profile_image = $newFileName;
                $user->save();
            }

            if ($data['role'] == config('role.doctor')) {
                $response = $this->updateDoctorProfile($data, $user->id);
                if (!$response['success']) {
                    DB::rollBack();
                    return $response;
                }
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'User updated successfully'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while updating user' . $e
            ];
        }
    }

    public function getDoctorsByClinicId($clinicId)
    {
        try {
            $doctors = ClinicUser::with('user')->where('clinic_id', $clinicId)->where('role_id', config('role.doctor'))->get();
            return [
                'success' => true,
                'data' => [
                    'doctors' => $doctors,
                ],
                'message' => 'Doctors retrieved successfully',
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Unable to retrieve doctors',
            ];
        }
    }

    public function getClinicUserById($userId)
    {
        /*in future, when there're multiple role for the same user, we  need to pick this from ClinicUser instead of the User model.
        It also validates that a the user belongs to the same clinic automatically.
        using first because currently there's only one role per user. when the roles per user increase loops will be used.`
        */
        try {
            $user = User::where('id', $userId)->with('clinicRole')->firstOrFail();
            $user->setRelation('clinicRole', $user->clinicRole->first());
            return [
                'success' => true,
                'data' => [
                    'user' => $user,
                ],
                'message' => 'User retrieved successfully',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Unable to retrieve user',
            ];
        }
    }

    public function getTotalCliniUserCount($clinicId)
    {
        $response = ClinicUser::where('clinic_id', $clinicId)->count();
        return $response;
    }

    public function getClinicDoctorCount($clinicId)
    {
        $response = ClinicUser::where('clinic_id', $clinicId)->where('role_id', config('role.doctor'))->count();

        if (!$response) {
            return 0;
        }

        return $response;
    }

    public function getClinicPatientCount($clinicId)
    {
        $response = Patient::where('clinic_id', $clinicId)->where('role_id', config('role.patient'))->count();

        if (!$response) {
            return 0;
        }

        return $response;
    }
}
