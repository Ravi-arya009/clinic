<?php

namespace App\Services;

use App\Models\LabTestMaster;

class LabTestService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllTests()
    {
        $response = LabTestMaster::all();
        return $response;
    }
}
