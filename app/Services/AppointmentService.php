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
        $response = Appointment::where('patient_id', $patientId)->where('status', 0)->with('patient', 'doctor','dependent','clinic')->get();
        return $response;
    }

    public function getAppointment($appointmentId)
    {
        $response = Appointment::where('id', $appointmentId)->with('clinic', 'doctor', 'timeSlot')->first();
        return $response;
    }

    public function getUpcomingDoctorAppointments($doctorId, $clinicId)
    {
        $response = Appointment::where('clinic_id', $clinicId)->where('doctor_id', $doctorId)->where('status', 0)->with('patient', 'dependent', 'timeSlot')->get();
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

    public function getAppointmentById($appointmentId){
        $response = Appointment::with('patient', 'patient.city', 'patient.state', 'dependent', 'timeSlot', 'appointmentDetails', 'medications', 'labTests')->where('id', $appointmentId)->first();
        return $response;
    }

    public function storeAppointment($data)
    {
        try {
            DB::beginTransaction();

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
                'message' => 'An error occurred while saving the prescription.'
            ];
        }
    }
}
