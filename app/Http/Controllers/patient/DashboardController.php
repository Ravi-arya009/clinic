<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }
    public function dashboard()
    {
        $currentUser = Auth::guard('patients')->user();
        $totalPatientCount = Appointment::where('patient_id', $currentUser->id)->distinct('patient_id')->count();
        $totalDoctorAppointmentCount = Appointment::where('patient_id', $currentUser->id)->count();
        $upcomingAppointments = Appointment::where('patient_id', $currentUser->id)->with('patient', 'timeSlot')->orderBy('appointment_date', 'desc')->limit(7)->get();
        return view('patient.dashboard', compact('currentUser', 'upcomingAppointments', 'totalDoctorAppointmentCount', 'totalPatientCount'));
    }

    public function home()
    {
        return view('patient.home');
    }

    public function clinics()
    {
        $clinics = Clinic::with('speciality')->get();
        return view('patient.clinics', compact('clinics'));
    }

    public function show($clinicId)
    {
        $clinic = Clinic::where('id', $clinicId)->get();
        return view('patient.view_clinic', ['clinic' => $clinic]);
    }
}
