<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\dependant;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        $bookingData = (object) $request->all(); // putting frequently needed data in a variable to reduce I/O calls
        if (auth()->guard('patients')->check()) {
            $loggedInUser = auth()->guard('patients')->user();
        } else {
            $loggedInUser = null;
        }
        return view('guest.create_appointment', compact('bookingData', 'loggedInUser'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $bookingData = json_decode($request->bookingData);
        $validatedData = $request->validated();

        if (auth()->guard('patients')->check()) {
            $patient_id = Auth::guard('patients')->id();
        } else {
            $patient = Patient::create([
                'id' => Str::uuid(),
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'whatsapp' => $validatedData['whatsapp'] ?? null,
                'email' => $validatedData['email'] ?? null,
                'dob' => $validatedData['dob'] ?? null,
                'gender' => $validatedData['gender'] ?? null,
                'password' => Hash::make($validatedData['password']),
            ]);
            $patient_id = $patient->id;
            Auth::guard('patients')->login($patient);
        }

        if ($request->booking_for == '2') {
            $dependant = dependant::create([
                'id' => Str::uuid(),
                'patient_id' => $patient_id,
                'relation' =>
                $validatedData['dependant_relation'],
                'name' => $validatedData['dependant_name'],
                'phone' => $validatedData['dependant_phone'],
                'whatsapp' => $validatedData['dependant_whatsapp'] ?? null,
                'email' => $validatedData['dependant_email'] ?? null,
                'dob' => $validatedData['dependant_dob'] ?? null,
                'gender' => $validatedData['dependant_gender'] ?? null,
            ]);
            $dependant_id = $dependant->id;
        }

        $appointment = Appointment::create([
            'id' => Str::uuid(),
            'patient_id' => $patient_id,
            'dependant_id' => $dependant_id ?? null,
            'doctor_id' => $bookingData->doctor_id,
            'clinic_id' => $bookingData->clinic_id,
            'time_slot_id' => $bookingData->slot_id,
            'appointment_date' => $bookingData->appointment_date,
            'booking_for' => $request->booking_for,
            'payment_method' => $request->payment_method
        ]);
        $appointmentId = $appointment->id;

        $appointment_date = $bookingData->appointment_date;
        $slot_id = $bookingData->slot_id;

        return view('guest.booking_confirmed', compact('bookingData', 'appointment_date', 'slot_id', 'appointmentId'));
    }

    public function downloadPrescriptionPdf(Request $request)
    {
        $appointment = json_decode($request->appointment_value);
        return view('global.prescription', compact('appointment'));
    }
}
