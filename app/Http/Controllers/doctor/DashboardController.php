<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
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
        $totalPatientCount = Appointment::where('clinic_id', $this->clinicId)->distinct('patient_id')->count();
        $totalDoctorAppointmentCount = Appointment::where('clinic_id', $this->clinicId)->count();
        $upcomingAppointments = Appointment::where('clinic_id', $this->clinicId)->with('patient', 'timeSlot')->orderBy('appointment_date', 'desc')->limit(7)->get();
        return view('doctor.dashboard',compact('upcomingAppointments', 'totalDoctorAppointmentCount', 'totalPatientCount'));
    }
}
