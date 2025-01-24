<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Clinic;
use App\Models\User;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $clinics = Clinic::all();
        $cities = City::all();
        $doctors = User::where('role',config('role.doctor'))->get();
        return view('guest.index', compact('clinics', 'cities', 'doctors'));
    }

    public function ShowDoctorProfile($doctorId)
    {
        $doctor = User::where('id', $doctorId)->first();
        return view('guest.doctor_profile', compact('doctor'));
    }

    public function ShowClinicProfile($clinicId)
    {
        $clinic = Clinic::where('id', $clinicId)->first();
        return view('guest.clinic_profile', compact('clinic'));
    }
}
