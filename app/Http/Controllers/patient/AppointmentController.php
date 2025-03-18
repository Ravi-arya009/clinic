<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Services\AppointmentService;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

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

    public function show($appointmentId)
    {
        $appointment = $this->appointmentService->getPatientAppointmentById($appointmentId);
        if ($appointment->dependant_id == null) {
            $patientId = $appointment->patient_id;
            $historicalAppointments = $this->appointmentService->getHistoricalAppointments('self', $patientId);
        } else {
            $dependantId = $appointment->dependant_id;
            $historicalAppointments = $this->appointmentService->getHistoricalAppointments('dependant', $dependantId);
        }
        $appointmentCount = $historicalAppointments->count();
        return view('patient.view_appointment', compact('appointment', 'appointmentCount', 'historicalAppointments'));
    }

    public function appointmentHistory()
    {
        $appointments = $this->appointmentService->getHistoricalPatientAppointments($this->patientId);
        return view('patient.appointments', compact('appointments'));
    }

    public function fetchAppointmentDetails(Request $request)
    {
        $appointmentId = $request->input('appointment_id');
        $historicalAppointmentDetails = $appointment = $this->appointmentService->getAppointmentById($appointmentId);
        return view('doctor.historicalAppointmentDetails', compact('historicalAppointmentDetails'));
    }

    public function generatePrescription(Request $request)
    {
        $appointmentId = $request->appointment_id;
        $appointment = $this->appointmentService->getPatientAppointmentById($appointmentId);
        return view('patient.view-prescription', compact('appointment'));
    }

    public function generateInvoice(Request $request)
    {
        $appointmentId = $request->appointment_id;
        $appointment = $this->appointmentService->getPatientAppointmentById($appointmentId);
        $billingDetails = Billing::where('appointment_id',$appointmentId)->first();
        // return $appointment;
        return view('patient.view-invoice', compact('appointment', 'billingDetails'));
    }
}
