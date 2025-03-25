<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\AppointmentMedication;
use App\Models\LabTestMaster;
use App\Models\LabTestsMAster;
use App\Models\MedicineMaster;
use App\Services\AppointmentService;
use App\Services\LabTestService;
use App\Services\MedicineService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    protected $clinicId, $appointmentService, $medicineService, $labTestService;

    public function __construct(AppointmentService $appointmentService, MedicineService $medicineService, LabTestService $labTestService)
    {
        $this->appointmentService = $appointmentService;
        $this->medicineService = $medicineService;
        $this->labTestService = $labTestService;
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function index()
    {

        $appointments = Appointment::where('clinic_id', $this->clinicId)->with('patient', 'timeSlot')->get();
        return view('admin.appointments', compact('appointments'));
    }
    public function show(Request $request)
    {
        $appointmentId = $request->appointmentId;
        $appointment = $this->appointmentService->getAppointmentById($request->appointmentId);
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
        return view('admin.view_appointment', compact('appointment', 'medicines', 'laboratoryTests', 'historicalAppointments', 'appointmentCount'));
    }

    // public function store(Request $request)
    // {
    //     $appointmentDetails = AppointmentDetail::updateOrCreate(
    //         ['appointment_id' => $request->appointment_id],
    //         [
    //             'advice' => $request->advice,
    //             'notes' => $request->notes,
    //         ]
    //     );

    //     if (isset($request->medicine_id)) {
    //         foreach ($request->medicine_id as $key => $medicineId) {
    //             AppointmentMedication::create([
    //                 'id' => Str::uuid(),
    //                 'appointment_id' => $request->appointment_id,
    //                 'medicine_id' => $medicineId,
    //                 'dosage' => $request->dosage[$key],
    //                 'duration' => $request->duration[$key],
    //                 'instructions' => $request->instructions[$key],
    //             ]);
    //         }
    //     }

    //     return redirect()->back()->withInput()->with('success', 'Details saved successfully!');
    // }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
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
            ]);

            // Create appointment details
            $appointmentDetails = AppointmentDetail::updateOrCreate(
                ['appointment_id' => $request->appointment_id],
                [
                    'advice' => $request->advice,
                    'notes' => $request->notes,
                ]
            );

            AppointmentMedication::where('appointment_id', $request->appointment_id)->delete();

            // Create medications if any
            if ($request->has('medicine_id')) {
                collect($request->medicine_id)
                    ->map(function ($medicineId, $key) use ($request) {
                        return [
                            'id' => Str::uuid(),
                            'appointment_id' => $request->appointment_id,
                            'medicine_id' => $medicineId,
                            'dosage' => $request->dosage[$key],
                            'duration' => $request->duration[$key],
                            'instructions' => $request->instructions[$key] ?? null,
                        ];
                    })
                    ->each(fn($medication) => AppointmentMedication::create($medication));
            }

            DB::commit();
            return redirect()->back()->with('success', 'Details saved successfully!');
        } catch (QueryException $e) {
            DB::rollback();

            // Check if it's a duplicate entry error
            if ($e->errorInfo[1] === 1062) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['medicine_id' => 'This medicine is already prescribed for this appointment.'])
                    ->with('error', 'Duplicate medicine found in prescription.');
            }

            // Handle other database errors
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while saving the prescription.']);
        }
    }

    public function fetchAppointmentDetails(Request $request)
    {
        $appointmentId = $request->input('appointment_id');
        $historicalAppointmentDetails = $appointment = $this->appointmentService->getAppointmentById($appointmentId);
        return view('doctor.historicalAppointmentDetails', compact('historicalAppointmentDetails'));
    }
}
