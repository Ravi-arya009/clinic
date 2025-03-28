<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\AppointmentLabTest;
use App\Models\AppointmentMedication;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppointmentService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return "this is index function";
    }

    public function getPatientAppointments($patientId)
    {
        $response = Appointment::where('patient_id', $patientId)->where('status', 0)->with('patient', 'doctor', 'dependant', 'clinic')->get();
        return $response;
    }

    public function getAppointment($appointmentId)
    {
        $response = Appointment::where('id', $appointmentId)->with('clinic', 'doctor', 'timeSlot')->first();
        return $response;
    }

    public function getUpcomingDoctorAppointments($doctorId, $clinicId)
    {
        $response = Appointment::where('clinic_id', $clinicId)->where('doctor_id', $doctorId)->where('status', 0)->with('patient', 'dependant', 'timeSlot')->get();
        return $response;
    }

    public function getHistoricalDoctorAppointments($doctorId, $clinicId)
    {
        $response = Appointment::where('clinic_id', $clinicId)->where('doctor_id', $doctorId)->where('status', 1)->with('patient', 'timeSlot')->get();
        return $response;
    }

    public function getHistoricalPatientAppointments($patientId)
    {
        $response = Appointment::where('patient_id', $patientId)->where('status', 1)->with('patient', 'timeSlot')->get();
        return $response;
    }

    public function getAppointmentById($appointmentId)
    {
        $response = Appointment::with('clinic', 'doctor', 'patient', 'patient.city', 'patient.state', 'dependant', 'timeSlot', 'appointmentDetails', 'medications', 'labTests')->where('id', $appointmentId)->first();
        return $response;
    }

    public function getPatientAppointmentById($appointmentId)
    {
        $response = Appointment::with('clinic', 'doctor', 'doctor.doctorProfile.qualification', 'patient', 'patient.city', 'patient.state', 'dependant', 'timeSlot', 'appointmentDetails', 'medications', 'labTests.labTestMaster')->where('id', $appointmentId)->first();
        return $response;
    }
    public function getUpcomingClinicAppointments($clinicId)
    {
        $response = Appointment::where('clinic_id', $clinicId)->where('status', 0)->with('patient', 'dependant', 'timeSlot', 'billing')->get();
        return $response;
    }

    public function storeAppointment($data)
    {
        // return $data;
        DB::beginTransaction();

        try {
            // Create appointment details
            AppointmentDetail::updateOrCreate(
                ['appointment_id' => $data['appointment_id']],
                [
                    'advice' => $data['advice'],
                    'notes' => $data['notes'],
                ]
            );

            //deleting already set medications
            AppointmentMedication::where('appointment_id', $data['appointment_id'])->delete();
            // Create medications if any
            if (isset($data['medicine_id'])) {
                collect($data['medicine_id'])
                    ->map(function ($medicineId, $key) use ($data) {
                        return [
                            'id' => Str::uuid(),
                            'appointment_id' => $data['appointment_id'],
                            'medicine_id' => $medicineId,
                            'dosage' => $data['dosage'][$key],
                            'duration' => $data['duration'][$key],
                            'instructions' => $data['instructions'][$key] ?? null,
                        ];
                    })
                    ->each(fn($medication) => AppointmentMedication::create($medication));
            }

            //deleting already set test
            AppointmentLabTest::where('appointment_id', $data['appointment_id'])->delete();
            // Create lab tests if any
            if (isset($data['lab_test_id'])) {
                collect($data['lab_test_id'])
                    ->map(function ($labTestId, $key) use ($data) {
                        return [
                            'id' => Str::uuid(),
                            'appointment_id' => $data['appointment_id'],
                            'lab_test_id' => $labTestId,
                        ];
                    })
                    ->each(fn($labTest) => AppointmentLabTest::create($labTest));
            }

            // updating the appointment status
            Appointment::where('id', $data['appointment_id'])->update(['status' => 1]);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Appointment saved successfully'
            ];
        } catch (QueryException $e) {
            DB::rollback();
            // Check if it's a duplicate entry error
            if ($e->errorInfo[1] === 1062) {

                $errorMessage = $e->getMessage();

                if (
                    str_contains($errorMessage, 'appointment_medications') ||
                    str_contains($errorMessage, 'unique_medicine_per_appointment')
                ) {
                    return [
                        'success' => false,
                        'message' => 'A duplicate medicine entry found for this appointment.'
                    ];
                }

                if (
                    str_contains($errorMessage, 'appointment_lab_tests') ||
                    str_contains($errorMessage, 'unique_lab_test_per_appointment')
                ) {
                    return [
                        'success' => false,
                        'message' => 'A duplicate lab test entry found for this appointment.'
                    ];
                }
            }
            // Handle other database errors
            return [
                'success' => false,
                'message' => 'An error occurred while saving the appointment.' . $e
            ];
        }
    }

    public function createWalkInAppointment($patientId, $dependantId, $doctorId, $clinicId, $timeSlotId)
    {

        try {
            $appointment = Appointment::create([
                'id' => Str::uuid(),
                'patient_id' => $patientId,
                'dependant_id' => $dependantId,
                'doctor_id' => $doctorId,
                'clinic_id' => $clinicId,
                'time_slot_id' => $timeSlotId,
                'appointment_date' => now()->format('Y-m-d'),
                'booking_for' => 1, //self
                'appointment_type' => 2, // Walk-in
                'payment_method' => 0, //pending
            ]);

            return [
                'success' => true,
                'data' => [
                    'appointment' => $appointment,
                    'redirectRoute' => route('doctor.appointment.show', $appointment->id),
                ],
                'message' => 'Appointment created successfully!',
            ];
        } catch (QueryException $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while creating appointment'
            ];
        }
    }

    public function getHistoricalAppointments($appointmentFor, $userId)
    {
        if ($appointmentFor == 'self') {
            $response = Appointment::where('patient_id', $userId)->where('dependant_id', null)->get();
        }
        if ($appointmentFor == 'dependant') {
            $response = Appointment::where('dependant_id', $userId)->get();
        }
        return $response;
    }
}
