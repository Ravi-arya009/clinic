<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerscriptionController extends Controller
{
    public function index(){
        return view('patient.perscription');
    }
}
