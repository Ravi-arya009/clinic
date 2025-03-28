<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use App\Services\LabTestService;
use App\Services\MedicineService;
use App\Services\TimeSlotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    protected $clinicId, $appointmentService, $timeSlotService, $medicineService, $labTestService;

    public function __construct(
        AppointmentService $appointmentService,
        TimeSlotService $timeSlotService,
        MedicineService $medicineService,
        LabTestService $labTestService
    ) {
        $this->appointmentService = $appointmentService;
        $this->timeSlotService = $timeSlotService;
        $this->medicineService = $medicineService;
        $this->labTestService = $labTestService;
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function upcomingAppointments()
    {
        $appointments = $this->appointmentService->getUpcomingDoctorAppointments(auth()->guard('doctor')->user()->id, $this->clinicId);
        return view('doctor.appointments', compact('appointments'));
    }

    public function appointmentHistory()
    {
        $appointments = $this->appointmentService->getHistoricalDoctorAppointments(auth()->guard('doctor')->user()->id, $this->clinicId);
        return view('doctor.appointments', compact('appointments'));
    }

    public function show(Request $request)
    {
        $appointment = $this->appointmentService->getAppointmentById($request->appointmentId);
        dd($appointment);
        if ($appointment->dependant_id == null) {
            $patientId = $appointment->patient_id;
            $historicalAppointments = $this->appointmentService->getHistoricalAppointments('self', $patientId);
        } else {
            $dependantId = $appointment->dependant_id;
            $historicalAppointments = $this->appointmentService->getHistoricalAppointments('dependant', $dependantId);
        }
        $appointmentCount = $historicalAppointments->count();
        $medicines = $this->medicineService->getClinicMedicines($this->clinicId);
        $laboratoryTests = $this->labTestService->getAllTests();
        return view('doctor.view_appointment', compact('appointment', 'medicines', 'laboratoryTests', 'historicalAppointments', 'appointmentCount'));
    }

    public function store(Request $request)
    {
        //handling empty medicines and labtests.
        if (($request->medicine_id[0] ?? '') === "Select") {
            $request->request->remove('medicine_id');
            $request->request->remove('dosage');
            $request->request->remove('duration');
            $request->request->remove('instructions');
        }

        if (($request->lab_test_id[0] ?? '') === "Select") {
            $request->request->remove('lab_test_id');
        }

        $validatedData = $request->validate([
            'appointment_id' => 'required|uuid|exists:appointments,id',
            'advice' => 'nullable|string',
            'notes' => 'nullable|string',
            'medicine_id' => 'nullable|array',
            'medicine_id.*' => 'required|uuid|exists:medicine_masters,id',
            'dosage' => 'required_with:medicine_id|array',
            'dosage.*' => 'required|string',
            'duration' => 'required_with:medicine_id|array',
            'duration.*' => 'required|string',
            'instructions' => 'nullable|array',
            'instructions.*' => 'nullable|string',
            'lab_test_id' => 'nullable|array',
            'lab_test_id.*' => 'required|uuid|exists:lab_test_masters,id',
        ]);

        $response = $this->appointmentService->storeAppointment($validatedData);

        if ($response['success']) {
            session()->flash('success', $response['message']);
            return redirect()->back()->with('success', $response['message']);
        } else {
            return redirect()->back()->withInput()->with('error', $response['message']);
        }
    }

    public function fetchAppointmentDetails(Request $request)
    {
        $appointmentId = $request->input('appointment_id');
        $historicalAppointmentDetails = $appointment = $this->appointmentService->getAppointmentById($appointmentId);
        return view('doctor.historicalAppointmentDetails', compact('historicalAppointmentDetails'));
    }

    ################
    public function storeWalkInAppointment($patientId, $dependantId = null)
    {
        $response = $this->timeSlotService->storeWalkInTimeSlot($this->clinicId, auth()->guard('doctor')->user()->id);
        if (!$response['success']) {
            return $response;
        }
        $timeSlot = $response['data']['timeSlot'];
        $response = $this->appointmentService->createWalkInAppointment($patientId, $dependantId, auth()->guard('doctor')->user()->id, $this->clinicId, $timeSlot->id);
        if (!$response['success']) {
            return $response;
        }
        $appointmentId = $response['data']['appointment']->id;
        // dd($appointmentId);
        return redirect(route('doctor.appointment.show', ['appointmentId' => $appointmentId]));
    }
}
