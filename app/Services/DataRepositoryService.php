<?php

namespace App\Services;

use App\Models\City;
use App\Models\Speciality;
use App\Models\State;

class DataRepositoryService
{

    public function __construct()
    {
        //

    }

    public function getAllCities()
    {
        try {
            return City::where('status', 1)->orderBy('name', 'asc')->get();
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
            return State::where('status', 1)->orderBy('name', 'asc')->get();
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
            return Speciality::where('status', 1)->orderBy('name', 'asc')->get();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Unable to fetch specialities'
            ];
        }
    }
}
