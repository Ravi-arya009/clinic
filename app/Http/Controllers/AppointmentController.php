<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Database\QueryException;
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

    public function store(Request $request)
    {
        $bookingData = json_decode($request->bookingData);
        if (auth()->guard('patients')->check()) {
            $patient_id = Auth::guard('patients')->id();
        } else {
            //in future make an api call. currently can't do because the store method is returning a view.
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|digits_between:10,13|unique:patients,phone',
                'email' => 'email',
                'password' => 'required|min:4|confirmed',
            ]);

            $patient = Patient::create([
                'id' => Str::uuid(),
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $patient_id = $patient->id;
            Auth::guard('patients')->login($patient);
        }
        try {
            Appointment::create([
                'id' => Str::uuid(),
                'patient_id' => $patient_id,
                'doctor_id' => $bookingData->doctor_id,
                'clinic_id' => $bookingData->clinic_id,
                'time_slot_id' => $bookingData->slot_id,
                'appointment_date' => $bookingData->appointment_date,
                'payment_method' => $request->payment_method
            ]);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) { // 23000 is the SQLSTATE code for integrity constraint violations
                return back()->withErrors([
                    'error' => "Something went wrong",
                ])->withInput();
            }
        }

        $appointment_date = $bookingData->appointment_date;
        $slot_id = $bookingData->slot_id;
        return view('guest.booking_confirmed', compact('bookingData', 'appointment_date', 'slot_id'));
    }
}
