<?php

namespace App\Services;

use App\Models\Appointment;

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

    public function getPatientAppointments($patientId){
        $patientAppointments = Appointment::where('patient_id', $patientId)->with('patient','doctor')->get();
        return $patientAppointments;
    }

    public function getAppointment($appointmentId){
        $appointment = Appointment::where('id', $appointmentId)->with('clinic','doctor','timeSlot')->first();
        return $appointment;
    }
}
