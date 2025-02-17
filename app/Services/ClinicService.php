<?php

namespace App\Services;

use App\Models\Clinic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClinicService
{
    /**
     * Create a new class instance.
     */
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
        /* Both clinic and admin transaction should succeed or both should fail,
        hence a try catch block with db transaction. */
        DB::beginTransaction();

        try {
            $clinic = Clinic::create([
                'id' => Str::uuid(),
                'name' => $data['name'],
                'slug' => $data['slug'],
                'phone' => $data['phone'],
                'contact_person' => $data['contact_person'],
                'contact_person_phone' => $data['contact_person_phone'],
                'state_id' => $data['state'],
                'city_id' => $data['city'],
                'address' => $data['address'],
                'area' => $data['area'],
                'speciality_id' => $data['speciality'],
            ]);

            $this->userService->storeClinicAdmin($data['admin_name'], $data['admin_phone'], $clinic->id);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Clinic registered successfully!',
                'clinicId' => $clinic->id
            ];
        } catch (\Throwable $e) {
            throw $e;
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Something Went wrong'
            ];
        }
    }

    public function updateClinic($clinicId, $data)
    {
        /* Both clinic and admin transaction should succeed or both should fail,
        hence a try catch block with db transaction. */
        DB::beginTransaction();

        try {
            $clinic = Clinic::findorFail($clinicId);
            $clinic->name = $data['name'];
            $clinic->slug = $data['slug'];
            $clinic->phone = $data['phone'];
            $clinic->contact_person = $data['contact_person'];
            $clinic->contact_person_phone = $data['contact_person_phone'];
            $clinic->state_id = $data['state'];
            $clinic->city_id = $data['city'];
            $clinic->address = $data['address'];
            $clinic->area = $data['area'];
            $clinic->speciality_id = $data['speciality'];
            $clinic->save();

            //updating clinic admin
            $this->userService->updateClinicAdmin($data['admin_id'], $data['admin_name'], $data['admin_phone']);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Clinic registered successfully!'
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Something Went wrong'
            ];
        }
    }
}
