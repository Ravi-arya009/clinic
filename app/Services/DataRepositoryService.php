<?php

namespace App\Services;

use App\Models\City;
use App\Models\Qualification;
use App\Models\Speciality;
use App\Models\State;

class DataRepositoryService
{

    public function __construct()
    {
        //cache everything on this service to minimize db calls
    }

    public function getAllCities()
    {
        try {
            return City::where('is_active', 1)->orderBy('name', 'asc')->get();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Unable to fetch cities'
            ];
        }
    }

    public function getAllStates()
    {
        try {
            return State::where('is_active', 1)->orderBy('name', 'asc')->get();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Unable to fetch states'
            ];
        }
    }

    public function getAllSpecialities()
    {
        try {
            return Speciality::where('is_active', 1)->orderBy('name', 'asc')->get();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Unable to fetch specialities'
            ];
        }
    }

    public function getAllQualifications()
    {
        try {
            return Qualification::orderBy('name', 'asc')->get();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Unable to fetch specialities'
            ];
        }
    }
}
