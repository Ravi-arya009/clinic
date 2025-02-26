<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Clinic;
use App\Models\Speciality;
use App\Models\User;
use App\Services\ClinicService;
use App\Services\DataRepositoryService;
use App\Services\DoctorService;

class WebsiteController extends Controller
{
    protected $clinicService, $doctorService, $dataRepositoryService;
    public function __construct(
        ClinicService $clinicService,
        DoctorService $doctorService,
        DataRepositoryService $dataRepositoryService
        )
    {
        $this->clinicService = $clinicService;
        $this->doctorService = $doctorService;
        $this->dataRepositoryService = $dataRepositoryService;

    }
    public function index()
    {
        $clinics = $this->clinicService->getTopClinics();
        $cities = $this->dataRepositoryService->getAllCities();
        // $doctors = User::with('doctorProfile.speciality', 'city')->where('role_id', config('role.doctor'))->limit(10)->get();
        $doctors = $this->doctorService->getTopDoctors();
        // $this->doctorTransformer($doctors);
        $specialities = $this->dataRepositoryService->getTopSpecialities();

        return view('guest.index', compact('clinics', 'cities', 'doctors', 'specialities'));
    }

    public function ShowDoctorProfile($doctorId)
    {
        $doctor = User::with(
            'timeSlots',
            'doctorProfile',
            'doctorProfile.speciality',
            'doctorProfile.qualification',
            'clinic'
        )->findOrFail($doctorId);

        $doctor->timeSlots = $doctor->timeSlots->groupBy('day_of_week');
        $doctor->slotsByDate = $this->makeDateWiseSlots($doctor); //creating day wise time slots
        $this->doctorTransformer($doctor); //transforming doctor collection for easy navigation
        return view('guest.doctor_profile', compact('doctor'));
    }

    public function ShowClinicProfile($clinicId)
    {
        $clinic = Clinic::where('id', $clinicId)->first();
        return view('guest.clinic_profile', compact('clinic'));
    }

    protected function makeDateWiseSlots($doctor)
    {
        if (!$doctor->timeSlots->isEmpty()) {
            $currentDate = date('Y-m-d');
            for ($i = 0; $i < 10; $i++) {
                $dayNumber = date('N', strtotime($currentDate));
                if (isset($doctor->timeSlots[$dayNumber])) {
                    $slotsByDate[$currentDate] = $doctor->timeSlots[$dayNumber];
                    $slotsByDate[$currentDate]->dayName = date('l', strtotime($currentDate));
                }
                $currentDate = date('Y-m-d', strtotime('+1 day', strtotime($currentDate)));
            }
        } else {
            $slotsByDate = [];
        }
        return $slotsByDate;
    }

    protected function doctorTransformer($doctors)
    {
        if (!$doctors instanceof \Illuminate\Support\Collection) {
            $doctors = collect([$doctors]);
        }

        $doctors->transform(function ($doctor) {
            if ($doctor->doctorProfile->speciality) {
                $doctor->speciality = $doctor->doctorProfile->speciality;
                unset($doctor->doctorProfile->speciality);
            }

            if ($doctor->doctorProfile->qualification) {
                $doctor->qualification = $doctor->doctorProfile->qualification;
                unset($doctor->doctorProfile->qualification);
            }

            if ($doctor->timeSlots) {
                unset($doctor->timeSlots);
            }

            return $doctor;
        });

        return $doctors->first() ?? $doctors;
    }
}
