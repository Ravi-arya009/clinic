<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Doctor;
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
    ) {
        $this->clinicService = $clinicService;
        $this->doctorService = $doctorService;
        $this->dataRepositoryService = $dataRepositoryService;
    }
    public function index()
    {
        $cities = $this->dataRepositoryService->getAllCities();
        $specialities = $this->dataRepositoryService->getTopSpecialities();
        $clinics = $this->clinicService->getTopClinics();
        $doctors = $this->doctorService->getTopDoctors();
        return view('guest.index', compact('clinics', 'cities', 'doctors', 'specialities'));
    }

    public function ShowDoctorProfile($doctorId)
    {
        $doctor = $this->doctorService->getDoctorById($doctorId);
        //currently fetching only 1 clinic, in future, a single doctor can be associated with multiple clinics. Remove first() in that case and loop on frontend.
        $doctor->clinic = $this->clinicService->getClinicById($doctor->clinics->first()->clinic_id);
        $doctor->timeSlots = $doctor->timeSlots->groupBy('day_of_week');
        $doctor->slotsByDate = $this->makeDateWiseSlots($doctor); //creating day wise time slots
        return view('guest.doctor_profile', compact('doctor'));
    }

    public function ShowClinicProfile($clinicId)
    {
        $clinic = Clinic::where('id', $clinicId)->first();
        return view('guest.clinic_profile', compact('clinic'));
    }

    //creates timeslots by date for n number of future days.
    protected function makeDateWiseSlots_old($doctor)
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


    protected function makeDateWiseSlots($doctor)
    {
        $slotsByDate = [];

        if (!$doctor->timeSlots->isEmpty()) {
            $currentDate = date('Y-m-d');

            $bookedAppointments = Appointment::where('doctor_id', $doctor->id)
                ->where('appointment_date', '>=', $currentDate)
                ->where('appointment_date', '<=', date('Y-m-d', strtotime('+9 days', strtotime($currentDate))))
                ->get()
                ->groupBy('appointment_date');

            for ($i = 0; $i < 10; $i++) {
                $dayNumber = date('N', strtotime($currentDate));

                if (isset($doctor->timeSlots[$dayNumber])) {

                    $availableSlots = collect($doctor->timeSlots[$dayNumber]);

                    if (isset($bookedAppointments[$currentDate])) {
                        $bookedSlotIds = $bookedAppointments[$currentDate]->pluck('time_slot_id')->toArray();
                        $availableSlots = $availableSlots->filter(function ($slot) use ($bookedSlotIds) {
                            return !in_array($slot->id, $bookedSlotIds);
                        });
                    }

                    if ($availableSlots->count() > 0) {
                        $slotsByDate[$currentDate] = $availableSlots;
                        $slotsByDate[$currentDate]->dayName = date('l', strtotime($currentDate));
                    }
                }

                $currentDate = date('Y-m-d', strtotime('+1 day', strtotime($currentDate)));
            }
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
