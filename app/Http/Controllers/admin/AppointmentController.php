<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    protected $clinicId;

    public function __construct()
    {
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function index(){

        $appointments = Appointment::where('clinic_id', $this->clinicId)->with('patient', 'timeSlot')->get();
        return view('admin.appointments',compact('appointments'));
    }
}
