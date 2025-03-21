<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Billing;
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

        $temporaryPaymentDetails = $this->getTemporaryPaymentDetails($request);

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
                'relation' => $validatedData['dependant_relation'],
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
            'appointment_type' => 1,
            'payment_method' => $request->payment_method
        ]);
        $appointmentId = $appointment->id;

        Billing::create([
            'id' => Str::uuid(),
            'appointment_id' => $appointmentId,
            'amount_to_be_paid' => $bookingData->consultation_fee,
            'amount_paid' => $temporaryPaymentDetails['amount_paid'],
            'payment_status' => $temporaryPaymentDetails['payment_status'],
            'payment_method' => $request->payment_method
        ]);

        $appointment_date = $bookingData->appointment_date;
        $slot_id = $bookingData->slot_id;

        return view('guest.booking_confirmed', compact('bookingData', 'appointment_date', 'slot_id', 'appointmentId'));
    }

    public function downloadPrescriptionPdf(Request $request)
    {
        $appointment = json_decode($request->appointment_value);
        return view('global.prescription', compact('appointment'));
    }

    public function getTemporaryPaymentDetails($request)
    {
        //this function is a temporary function to mock the payment methods and details.
        //once the payment gateway is integrated these details will come form there.
        switch ($request->payment_method) {
            case 1:
                $TemporaryPaymentDetails['payment_status'] = 1;
                $TemporaryPaymentDetails['amount_paid'] = $request->consultation_fee;
                break;
            case 2:
                $TemporaryPaymentDetails['payment_status'] = 0;
                $TemporaryPaymentDetails['amount_paid'] = 0;
                break;
            case 3:
                $TemporaryPaymentDetails['payment_status'] = 0;
                $TemporaryPaymentDetails['amount_paid'] = (int) $request->consultation_fee / 2;
                break;

            default:
                $TemporaryPaymentDetails['payment_status'] = 0;
                $TemporaryPaymentDetails['amount_paid'] = 0;
                break;
        }
        return $TemporaryPaymentDetails;
    }
}
