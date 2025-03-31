<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\DataRepositoryService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    protected $clinicId, $userService, $dataRepositoryService;

    public function __construct(UserService $userService, DataRepositoryService $dataRepositoryService)
    {
        $this->clinicId = Session::get('current_clinic')['id'];
        $this->userService = $userService;
        $this->dataRepositoryService = $dataRepositoryService;
    }
    public function dashboard()
    {
        $totalPatientCount = Appointment::where('clinic_id', $this->clinicId)->where('doctor_id', Auth::guard('doctor')->user()->id)->distinct('patient_id')->count();
        $totalDoctorAppointmentCount = Appointment::where('clinic_id', $this->clinicId)->where('doctor_id', Auth::guard('doctor')->user()->id)->count();
        $upcomingAppointments = Appointment::where('clinic_id', $this->clinicId)->where('doctor_id', Auth::guard('doctor')->user()->id)->with('patient', 'timeSlot')->orderBy('appointment_date', 'desc')->limit(7)->get();
        // dd($upcomingAppointments);
        return view('doctor.dashboard', compact('upcomingAppointments', 'totalDoctorAppointmentCount', 'totalPatientCount'));
    }

    public function showProfile()
    {
        $states = $this->dataRepositoryService->getAllStates();
        $cities = $this->dataRepositoryService->getAllCities();
        $qualifications = $this->dataRepositoryService->getAllQualifications();
        $specialities = $this->dataRepositoryService->getAllSpecialities();
        $doctor = auth()->guard('doctor')->user();
        $doctor->doctorProfile = Doctor::where('user_id', $doctor->id)->with('user')->first();
        return view('doctor.profile', compact('doctor', 'states', 'cities', 'qualifications', 'specialities'));
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $validatedData = $request->validated();
        $response = $this->userService->updateUser($request->input('userId'), $validatedData);
        return $response;
    }
}
