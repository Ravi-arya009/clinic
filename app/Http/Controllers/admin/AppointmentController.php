<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\AppointmentMedication;
use App\Models\MedicineMaster;
use Illuminate\Http\Request;
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

        $appointments = Appointment::where('clinic_id', $this->clinicId)->with('patient', 'timeSlot')->get();
        return view('admin.appointments', compact('appointments'));
    }
    public function show(Request $request)
    {
        $appointmentId = $request->appointmentId;
        $appointment = Appointment::with('patient', 'timeSlot', 'appointmentDetails', 'medications')->where('id',$appointmentId)->first();
        $medicines = MedicineMaster::where('clinic_id', $this->clinicId)->get();
        dump($appointment);
        return view('admin.view_appointment', compact('appointment','medicines'));
    }

    public function store(Request $request)
    {
        $appointmentDetails = AppointmentDetail::create([
            'appointment_id' => $request->appointment_id,
            'advice' => $request->advice,
            'notes' => $request->notes,
        ]);

        foreach ($request->medicine_id as $key => $medicineId) {
            AppointmentMedication::create([
                'id' => Str::uuid(),
                'appointment_id' => $request->appointment_id,
                'medicine_id' => $medicineId,
                'dosage' => $request->dosage[$key],
                'duration' => $request->duration[$key],
                'instructions' => $request->instructions[$key],
            ]);
        }

        return redirect()->back()->withInput()->with('success', 'Details saved successfully!');
    }
}
