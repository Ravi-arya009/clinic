<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $currentUser = Auth::guard('patients')->user();
        return view('patient.dashboard', compact('currentUser'));
    }

    public function home()
    {
        return view('patient.home');
    }

    public function clinics()
    {
        $clinics = Clinic::with('speciality')->get();
        return view('patient.clinics', compact('clinics'));
    }

    public function show($clinicId)
    {
        $clinic = Clinic::where('id', $clinicId)->get();
        return view('patient.view_clinic', ['clinic' => $clinic]);
    }
}
