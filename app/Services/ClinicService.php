<?php

namespace App\Services;

use App\Models\Clinic;
use App\Models\ClinicWorkingHour;
use DateTime;
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

        if (!$response) {
            return null;
        }

        return $response;
    }

    public function getTopClinics()
    {
        $response = Clinic::with('speciality', 'city')->limit(10)->get();

        if (!$response) {
            return null;
        }

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

    public function getRecentClinics()
    {
        $response = Clinic::with('city')->limit(7)->orderBy('created_at', 'desc')->get();

        if (!$response) {
            return null;
        }

        return $response;
    }

    public function getClinicCount()
    {
        $response = Clinic::count();

        if (!$response) {
            return 0;
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

            //storing clinic logo
            if (isset($data['logo'])) {
                $clinicLogo = $data['logo'];
                $newFileName = $clinic->id . '.' . $clinicLogo->getClientOriginalExtension();
                $clinicLogo->storeAs('clinic_logos', $newFileName, 'public');
                $clinic->logo = $newFileName;
                $clinic->save();
            }

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

            if (isset($data['logo'])) {
                $clinicLogo = $data['logo'];
                $newFileName = $clinic->id . '.' . $clinicLogo->getClientOriginalExtension();
                $clinicLogo->storeAs('clinic_logos', $newFileName, 'public');
                $clinic->logo = $newFileName;
                $clinic->save();
            }

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

    public function storeClinicWorkingHours($clinicId, $clinic_working_hours)
    {
        foreach ($clinic_working_hours as $working_hour) {
            $day = $working_hour->day;
            $shift = $working_hour->shift;
            $opening_time = $working_hour->opening_time;
            $closing_time = $working_hour->closing_time;

            $opening_time = DateTime::createFromFormat('h:i A', $opening_time)->format('H:i');
            $closing_time = DateTime::createFromFormat('h:i A', $closing_time)->format('H:i');

            $ClinicWorkingHours = ClinicWorkingHour::create([
                'clinic_id' => $clinicId,
                'day' => $day,
                'shift' => $shift,
                'opening_time' => $opening_time,
                'closing_time' => $closing_time
            ]);
        }
    }
}
