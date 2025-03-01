<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Models\Dependent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DependentController extends Controller
{
    public function index(){

        $patientId = Auth::guard('patients')->user()->id;
        $dependents = Dependent::where('patient_id', $patientId)->get();
        return view('patient.family_members', compact('dependents'));
    }
}
