<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Appointment;
use App\Services\DataRepositoryService;
use App\Services\UserService;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    protected $clinicId, $userService, $dataRepositoryService;

    public function __construct(
        UserService $userService,
        DataRepositoryService $dataRepositoryService
    ) {
        $this->clinicId = Session::get('current_clinic')['id'];
        $this->userService = $userService;
        $this->dataRepositoryService = $dataRepositoryService;
    }

    public function dashboard()
    {

        // need to add a where clause. date is greater than equal to today.
        $upcomingAppointments = Appointment::where('clinic_id', $this->clinicId)->with('patient', 'timeSlot')->limit(7)->orderBy('appointment_date', 'desc')->get();
        $totalUserCount = $this->userService->getTotalCliniUserCount($this->clinicId);
        $totalDoctorCount = $this->userService->getClinicDoctorCount($this->clinicId);
        return view('admin.dashboard', compact('totalUserCount', 'totalDoctorCount', 'upcomingAppointments'));
    }
    public function showProfile()
    {
        $states = $this->dataRepositoryService->getAllStates();
        $cities = $this->dataRepositoryService->getAllCities();
        $admin = auth()->guard('admin')->user();
        return view('admin.profile', compact('admin', 'states', 'cities'));
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $validatedData = $request->validated();
        $response = $this->userService->updateUser($request->input('userId'), $validatedData);
        return $response;
    }
}
