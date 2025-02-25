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
}
