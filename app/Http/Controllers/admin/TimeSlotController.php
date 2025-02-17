<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use App\Models\User;
use App\Services\TimeSlotService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TimeSlotController extends Controller
{
    protected $clinicId, $timeSlotService;

    public function __construct(TimeSlotService $timeSlotService)
    {
        $this->timeSlotService = $timeSlotService;
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function index($clinicSlug, $doctorId = null)
    {
        $doctors = User::where('role_id', config('role.' . 'doctor'))->where('clinic_id', $this->clinicId)->get();

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
        try {
            $slot = TimeSlot::find($slotId);

            if (!$slot) {
                return response()->json([
                    'success' => false,
                    'message' => 'Slot not found'
                ], 404);
            } else {
                $slot->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Slot deleted successfully'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the slot',
                'error' => $e->getMessage()
            ], 500);  // Return a 500 server error if something goes wrong
        }
    }
}
