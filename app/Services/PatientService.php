<?php

namespace App\Services;

use App\Models\Patient;

class PatientService
{

    public function __construct()
    {
        //
    }

    public function getPatientCount()
    {
        $response = Patient::count();

        if (!$response) {
            return 0;
        }

        return $response;
    }
}
