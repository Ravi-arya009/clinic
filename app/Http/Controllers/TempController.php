<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\MedicineMaster;
use App\Models\temp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use illuminate\Support\Str;

class TempController extends Controller
{

    protected $clinicId;

    public function __construct()
    {
        $this->clinicId = Session::get('current_clinic')['id'];
    }
    public function index()
    {
        return view('temp');
    }
    public function temp()
    {
        $medicines = MedicineMaster::where('clinic_id', $this->clinicId)->get();
        return view('admin.temp', compact('medicines'));
    }
}
