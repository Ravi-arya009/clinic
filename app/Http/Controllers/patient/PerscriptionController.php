<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use Illuminate\Support\Facades\Auth;

class PerscriptionController extends Controller
{
    protected $appointmentService, $patientId;
    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
        $this->patientId = Auth::guard('patients')->user()->id;
    }

    public function index()
    {
        $appointments = $this->appointmentService->getHistoricalPatientAppointments($this->patientId);
        return view('patient.perscription', compact('appointments'));
    }
}
