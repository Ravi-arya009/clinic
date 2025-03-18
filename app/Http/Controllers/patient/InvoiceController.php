<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    protected $appointmentService, $patientId;
    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
        $this->patientId = Auth::guard('patients')->user()->id;
    }

    public function index(){
        $appointments = $this->appointmentService->getHistoricalPatientAppointments($this->patientId);
        return view('patient.invoices', compact('appointments'));
    }
}
