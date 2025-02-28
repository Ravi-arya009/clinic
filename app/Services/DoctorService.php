<?php

namespace App\Services;

use App\Models\Doctor;

class DoctorService
{

    public function __construct()
    {
        //
    }

    public function getDoctorCount()
    {
        $response = Doctor::count();

        if (!$response) {
            return 0;
        }

        return $response;
    }

    public function getTopDoctors()
    {
        $response = Doctor::with('user', 'user.city')->limit(10)->get();

        if (!$response) {
            return null;
        }

        return $response;
    }

    public function getDoctorById($doctorId)
    {
        $response = Doctor::with('user', 'clinics', 'speciality', 'qualification', 'timeSlots')->findOrFail($doctorId);
        if (!$response) {
            return [
                'success' => false,
                'message' => 'Doctor Not found'
            ];
        }

        return $response;
    }
}
