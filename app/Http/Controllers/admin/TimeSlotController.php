<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\TimeSlotService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TimeSlotController extends Controller
{
    protected $clinicId, $userService, $timeSlotService;

    public function __construct(UserService $userService, TimeSlotService $timeSlotService)
    {
        $this->userService = $userService;
        $this->timeSlotService = $timeSlotService;
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function index($clinicSlug, $doctorId = null)
    {
        $response = $this->userService->getDoctorsByClinicId($this->clinicId);
        $doctors = $response['data']['doctors'];
        if ($doctorId) {
            $timeSlots = $this->timeSlotService->getDoctorAvailableTimeSlots($doctorId);
        }
        return view('admin.available_timings', compact('doctors') + ($doctorId ? compact('timeSlots') : []));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'time' => 'required|date_format:h:i A',
            'days' => 'array',
            'days.*' => 'in:1,2,3,4,5,6,7',
            'doctor_id' => 'required|exists:users,id',
        ]);

        $result = $this->timeSlotService->storeTimeSlot($validatedData, $this->clinicId, $validatedData['doctor_id']);

        if (!$result['success']) {
            return back()->withErrors(['time' => $result['message']]);
        }

        return back()->with('success', 'Time slot added succesfully');
    }

    public function deleteSlot($slotId)
    {
        $response = $this->timeSlotService->deleteTimeSlot($slotId);
        return response()->json($response);
    }

    public function delete($clinicSlug, Request $request, $slotId)
    {
        return $this->timeSlotService->deleteTimeSlot($slotId);
    }
}
