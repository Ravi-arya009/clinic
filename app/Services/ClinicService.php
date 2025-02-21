<?php

namespace App\Services;

use App\Models\Clinic;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Throw_;

class ClinicService
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAllClinics()
    {
        $response = Clinic::orderBy('created_at', 'asc')->get();
        return $response;
    }

    public function getClinicById($clinicId, $with = [])
    {
        $response = Clinic::findorFail($clinicId);

        if (!empty($with)) {
            $response->load($with);
        }

        return $response;
    }

    public function storeClinic($data)
    {
        DB::beginTransaction();

        try {
            $clinic = Clinic::create([
                'id' => Str::uuid(),
                'name' => $data['name'],
                'slug' => $data['slug'],
                'phone' => $data['phone'],
                'whatsapp' => $data['whatsapp'],
                'email' => $data['email'],
                'state_id' => $data['state'],
                'city_id' => $data['city'],
                'address' => $data['address'],
                'pincode' => $data['pincode'],
                'area' => $data['area'],
                'speciality_id' => $data['speciality'],
                'contact_person' => $data['contact_person'],
                'contact_person_phone' => $data['contact_person_phone'],
                'contact_person_whatsapp' => $data['contact_person_whatsapp'],
            ]);

            $user = $this->userService->storeClinicAdmin($data['admin_name'], $data['admin_phone']);
            $assignedAdmin = $this->userService->assignClinicRoleToUser($user->id, $clinic->id, config('role.admin'));

            if (!$assignedAdmin['success']) {
                throw new \Exception('Admin role assignment failed');
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Clinic registered successfully!',
                'clinicId' => $clinic->id
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Something went wrong while registering clinic'
            ];
        }
    }

    public function updateClinic($clinicId, $data)
    {
        try {
            $clinic = Clinic::findorFail($clinicId);

            $clinic->update([
                'name' => $data['name'],
                'slug' => $data['slug'],
                'phone' => $data['phone'],
                'whatsapp' => $data['whatsapp'],
                'email' => $data['email'],
                'state_id' => $data['state'],
                'city_id' => $data['city'],
                'address' => $data['address'],
                'pincode' => $data['pincode'],
                'area' => $data['area'],
                'speciality_id' => $data['speciality'],
                'contact_person' => $data['contact_person'],
                'contact_person_phone' => $data['contact_person_phone'],
                'contact_person_whatsapp' => $data['contact_person_whatsapp']
            ]);

            return [
                'success' => true,
                'message' => 'Clinic updated successfully!'
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while updating clinic'
            ];
        }
    }
}
