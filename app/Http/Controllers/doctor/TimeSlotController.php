<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use App\Services\TimeSlotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TimeSlotController extends Controller
{
    protected $clinicId, $doctorId, $timeSlotService;

    public function __construct(TimeSlotService $timeSlotService)
    {
        $this->timeSlotService = $timeSlotService;
        $this->clinicId = Session::get('current_clinic')['id'];
        $this->doctorId = Auth::guard('doctor')->user()->id;
    }

    public function index()
    {
        $timeSlots = $this->timeSlotService->getDoctorAvailableTimeSlots($this->doctorId);
        return view('doctor.available_timings', compact('timeSlots'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'time' => 'required|date_format:h:i A',
            'days' => 'array',
            'days.*' => 'in:1,2,3,4,5,6,7',
        ]);

        $result = $this->timeSlotService->storeTimeSlot($validatedData, $this->clinicId, $this->doctorId);

        if (!$result['success']) {
            return back()->withErrors(['time' => $result['message']]);
        }

        return back()->with('success', 'Time slot added succesfully');
    }

    public function delete($clinicSlug, Request $request, $slotId)
    {
        return $this->timeSlotService->deleteTimeSlot($slotId);
    }
}
