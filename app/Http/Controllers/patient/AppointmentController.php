<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    protected $appointmentService, $patientId;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
        $this->patientId = Auth::guard('patients')->user()->id;
    }

    public function index()
    {
        $appointments = $this->appointmentService->getPatientAppointments($this->patientId);
        return view('patient.appointments', compact('appointments'));
    }

    public function show($appointmentId){
        $appointment = $this->appointmentService->getAppointmentById($appointmentId);
        return view('patient.view_appointment', compact('appointment'));
    }

    public function appointmentHistory()
    {
        $appointments = $this->appointmentService->getHistoricalPatientAppointments($this->patientId);
        return view('patient.appointments', compact('appointments'));
    }
}
