<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\City;
use App\Models\Patient;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Appointment::where('doctor_id', auth()->guard('doctor')->user()->id)
            ->with('patient')
            ->select('id', 'patient_id', 'appointment_date')
            ->get()
            ->unique('patient_id')
            ->map(function ($appointment) {
                $data = array_merge($appointment->toArray(), $appointment->patient->toArray());
                unset($data['patient']);
                return (object) $data;
            });
        return view('doctor.patient_list', compact('patients'));
    }

    public function show(Request $request, $clinicSlug, $patientId)
    {
        $patient = Patient::where('id', $patientId)->first();
        $cities = City::where('status', 1)->orderBy('name', 'asc')->get();
        $states = State::where('status', 1)->orderBy('name', 'asc')->get();
        return view('doctor.view_patient', compact('patient', 'cities', 'states'));
    }
    public function update(Request $request, $clinicSlug, $patientId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,13|unique:users,phone,' . $patientId,
            'whatsapp' => 'nullable|digits_between:10,13|unique:users,whatsapp,' . $patientId,
            'gender' => 'nullable|digits_between:1,2',
            'email' => 'nullable|email',
            'state' => 'nullable|exists:states,id',
            'city' => 'nullable|exists:cities,id',
            'area' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:511',
        ]);

        $user = Patient::where('id', $patientId)->firstOrFail();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->whatsapp = $request->whatsapp;
        $user->gender = $request->gender;
        $user->state_id = $request->state;
        $user->city_id = $request->city;
        $user->area = $request->area;
        $user->pincode = $request->pincode;
        $user->address = $request->address;
        $user->save();

        return redirect()->back()->with('success', 'Patient updated successfully!');
    }
}
