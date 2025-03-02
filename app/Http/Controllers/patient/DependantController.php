<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Models\dependant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dependantController extends Controller
{
    public function index(){

        $patientId = Auth::guard('patients')->user()->id;
        $dependants = dependant::where('patient_id', $patientId)->get();
        return view('patient.family_members', compact('dependants'));
    }
}
