<?php

namespace App\Services;

use App\Models\Clinic;
use App\Models\ClinicWorkingHour;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Database\QueryException;
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
        try {
            $clinics = Clinic::with('city')->where('is_active', 1)->orderBy('created_at', 'asc')->get();
            return [
                'success' => true,
                'data' => [
                    'clinics' => $clinics,
                    'totalClinics' => $clinics->count(),
                ],
                'message' => 'Clinics retrieved successfully',
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Unable to retrieve clinics',
            ];
        }
    }

    public function getTopClinics()
    {
        $response = Clinic::with('speciality', 'city')->limit(10)->get();

        if (!$response) {
            return null;
        }

        return $response;
    }

    public function getClinicById($clinicId)
    {
        try {
            $clinic = Clinic::with('admins')->with('WorkingHours')->findorFail($clinicId);
            return [
                'success' => true,
                'data' => [
                    'clinic' => $clinic,
                ],
                'message' => 'Clinic retrieved successfully',
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Unable to retrieve clinic',
            ];
        }
    }

    public function getRecentClinics()
    {
        $response = Clinic::with('city')->where('is_active', 1)->limit(7)->orderBy('created_at', 'desc')->get();

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

            $this->storeClinicWorkingHours($clinic->id, json_decode($data['clinic_working_hours'])); //Storing Clinic Working Hours
            $user = $this->userService->storeClinicAdmin($data['admin_name'], $data['admin_phone']); //Storing Clinic Admin
            $assignedAdmin = $this->userService->assignClinicRoleToUser($user->id, $clinic->id, config('role.admin')); //Assigning Admin Role

            DB::commit();

            return [
                'success' => true,
                'data' => [
                    'clinicId' => $clinic->id,
                    'redirectRoute' => route('super_admin.clinic.show', $clinic->id),
                ],
                'message' => 'Clinic registered successfully!',
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
        DB::beginTransaction();
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

            //Storing Clinic Working Hours
            if (isset($data['clinic_working_hours']) && json_decode($data['clinic_working_hours']) !== []) {
                $response = $this->storeClinicWorkingHours($clinic->id, json_decode($data['clinic_working_hours']));
                if (!$response['success']) {
                    DB::rollBack();
                    return $response;
                }
            }


            DB::commit();

            return [
                'success' => true,
                'message' => 'Clinic updated successfully!'
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Something went wrong while updating clinic',
            ];
        }
    }

    public function storeClinicWorkingHours($clinicId, $clinic_working_hours)
    {
        foreach ($clinic_working_hours as $working_hour) {
            try {
                $day = $working_hour->day;
                $shift = $working_hour->shift;
                $opening_time = $working_hour->opening_time;
                $closing_time = $working_hour->closing_time;

                $opening_time = DateTime::createFromFormat('h:i A', $opening_time)->format('H:i');
                $closing_time = DateTime::createFromFormat('h:i A', $closing_time)->format('H:i');
                $opening_time_in_24_hour_format = DateTime::createFromFormat('H:i', $opening_time)->format('g:i A');

                $ClinicWorkingHours = ClinicWorkingHour::create([
                    'clinic_id' => $clinicId,
                    'day' => $day,
                    'shift' => $shift,
                    'opening_time' => $opening_time,
                    'closing_time' => $closing_time
                ]);

                return [
                    'success' => true,
                    'message' => "Time Slot Created Successfully."
                ];
            } catch (QueryException $e) {
                if ($e->getCode() == 23000) { // 23000 is the SQLSTATE code for integrity constraint violations
                    $daysOfWeek = Carbon::getDays();
                    $dayName = $daysOfWeek[$day] ?? 'Unknown Day';
                    return [
                        'success' => false,
                        'message' => "Duplicate entry for {$dayName} {$opening_time_in_24_hour_format}.",
                    ];
                }
                return [
                    'success' => false,
                    'message' => "Something went wrong while creating time slot.",
                ];
                throw $e;
            }
        }
    }
}
