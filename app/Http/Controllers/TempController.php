<?php

namespace App\Http\Controllers;

use App\Models\MedicineMaster;
use Illuminate\Support\Facades\Session;
use illuminate\Support\Str;
use App\Services\TimeSlotService;

class TempController extends Controller
{

    protected $clinicId, $timeSlotService;

    public function __construct(TimeSlotService $timeSlotService)
    {
        $this->timeSlotService = $timeSlotService;
        $this->clinicId = Session::get('current_clinic')['id'];
    }
    public function index()
    {
        return $this->timeSlotService->getDoctorAvailableTimeSlots('9a9cf142-4f6c-4035-bf38-495d933dfa05');
    }
    public function temp()
    {
        $medicines = MedicineMaster::where('clinic_id', $this->clinicId)->get();
        return view('admin.temp', compact('medicines'));
    }

}
