<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Str;

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

    public function store($data)
    {
        try {
            $patient = Patient::create([
                'id' => Str::uuid(),
                'name' => $data['name'],
                'phone' => $data['phone'],
                'whatsapp' => $data['whatsapp'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'dob' => date('Y-m-d', strtotime($data['dob'])),
                'state_id' => $data['state'],
                'city_id' => $data['city'],
                'address' => $data['address'],
                'pincode' => $data['pincode'],
                'password' => Hash::make('ravi'),
            ]);

            if (!$patient) {
                return [
                    'success' => false,
                    'message' => 'Something went wrong while creating Patient'
                ];
            }
            return [
                'success' => true,
                'message' => 'Patient created successfully',
                'data' => $patient
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while creating Patient'
            ];
        }
    }

    public function update($patientId, $data)
    {

        try {
            $patient = Patient::findOrFail($patientId);

            if (!$patient) {
                return [
                    'success' => false,
                    'message' => 'Patient not found'
                ];
            }

            $patient->name = $data['name'];
            $patient->phone = $data['phone'];
            $patient->whatsapp = $data['whatsapp'];
            $patient->email = $data['email'];
            $patient->gender = $data['gender'];
            $patient->dob = $data['dob'];
            $patient->state_id = $data['state'];
            $patient->city_id = $data['city'];
            $patient->address = $data['address'];
            $patient->pincode = $data['pincode'];
            $patient->save();

            return [
                'success' => true,
                'message' => 'Patient updated successfully'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong while updating patient'
            ];
        }
    }
}
