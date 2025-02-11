<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\AppointmentLabTest;
use App\Models\AppointmentMedication;
use App\Models\LabTestMaster;
use App\Models\MedicineMaster;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    protected $clinicId;

    public function __construct()
    {
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function index()
    {
        $appointments = Appointment::where('clinic_id', $this->clinicId)->where('status', 0)->where('doctor_id', auth()->guard('doctor')->user()->id)->with('patient', 'timeSlot')->get();
        return view('doctor.appointments', compact('appointments'));
    }
    public function show(Request $request)
    {
        $appointmentId = $request->appointmentId;
        $appointment = Appointment::with('patient', 'timeSlot', 'appointmentDetails', 'medications', 'labTests')->where('id', $appointmentId)->first();
        $medicines = MedicineMaster::where('clinic_id', $this->clinicId)->get();
        $laboratoryTests = LabTestMaster::all();
        return view('doctor.view_appointment', compact('appointment', 'medicines', 'laboratoryTests'));
    }
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
                'lab_test_id' => 'nullable|array',
                'lab_test_id.*' => 'required|uuid|exists:lab_test_masters,id',
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
            // Create lab tests if any
            AppointmentLabTest::where('appointment_id', $request->appointment_id)->delete();
            if ($request->has('lab_test_id')) {
                collect($request->lab_test_id)
                    ->map(function ($labTestId, $key) use ($request) {
                        return [
                            'id' => Str::uuid(),
                            'appointment_id' => $request->appointment_id,
                            'lab_test_id' => $labTestId,
                        ];
                    })
                    ->each(fn($labTest) => AppointmentLabTest::create($labTest));
            }

            Appointment::where('id', $validated['appointment_id'])->update(['status' => 1]);

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

    public function appointmentHistory(){
        $appointments = Appointment::where('clinic_id', $this->clinicId)->where('status', 1)->where('doctor_id', auth()->guard('doctor')->user()->id)->with('patient', 'timeSlot')->get();
        return view('doctor.appointments', compact('appointments'));
    }
}
