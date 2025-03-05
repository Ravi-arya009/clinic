<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Services\UserService;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    protected $clinicId, $userService;

    public function __construct(
        UserService $userService,
    ) {
        $this->clinicId = Session::get('current_clinic')['id'];
        $this->userService = $userService;
    }

    public function dashboard()
    {

        // need to add a where clause. date is greater than equal to today.
        $upcomingAppointments = Appointment::where('clinic_id', $this->clinicId)->with('patient', 'timeSlot')->orderBy('appointment_date', 'desc')->get();
        $totalUserCount = $this->userService->getTotalCliniUserCount($this->clinicId);
        $totalDoctorCount = $this->userService->getClinicDoctorCount($this->clinicId);
        return view('admin.dashboard', compact('totalUserCount', 'totalDoctorCount', 'upcomingAppointments'));
    }
}
