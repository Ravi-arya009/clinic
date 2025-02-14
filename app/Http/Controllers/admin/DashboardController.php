<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    protected $clinicId;

    public function __construct()
    {
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function dashboard()
    {

        // need to add a where clause. date is greater than equal to today.
        $upcomingAppointments = Appointment::where('clinic_id',$this->clinicId)->with('patient', 'timeSlot')->orderBy('appointment_date', 'desc')->get();
        return view('admin.dashboard', compact('upcomingAppointments'));
    }
}
