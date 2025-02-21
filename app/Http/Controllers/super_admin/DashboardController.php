<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // $clinics = Clinic::with('city')->limit(7)->orderBy('created_at', 'desc')->get();
        // $totalClinics = Clinic::count();
        // $totalPatients = Patient::count();
        // $totalDoctors = User::where('role_id', config('role.doctor'))->count();
        // return view('super_admin.dashboard', compact('clinics', 'totalClinics', 'totalDoctors','totalPatients'));
        return view('super_admin.dashboard', ['clinics'=>null, 'totalClinics' => 1, 'totalDoctors' => 1, 'totalPatients' => 1]);
    }
}
