<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TimeSlotController extends Controller
{
    protected $clinicId;

    public function __construct()
    {
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function availableTimings($clinicSlug, $doctorId = null)
    {
        $doctors = User::where('role', config('role.' . 'doctor'))->where('clinic_id', $this->clinicId)->get();

        if ($doctorId) {
            $timeSlots = TimeSlot::where('doctor_id', $doctorId)->orderBy('slot_time', 'asc')->get()->groupBy('day_of_week');
        }

        return view('admin.available_timings', compact('doctors') + ($doctorId ? compact('timeSlots') : []));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'time' => 'required|date_format:h:i A',
            'days' => 'array',
            'days.*' => 'in:1,2,3,4,5,6,7',
        ]);

        $validated['time'] = DateTime::createFromFormat('h:i A', $validated['time'])->format('H:i');

        foreach ($validated['days'] ?? [] as $day) {

            try {
                TimeSlot::create([
                    'id' => Str::uuid(),
                    'slot_time' => $validated['time'],
                    'day_of_week' => $day,
                    'doctor_id' => $request->doctor_id,
                    'clinic_id' => $this->clinicId,
                ]);
            } catch (QueryException $e) {

                if ($e->getCode() == 23000) { // 23000 is the SQLSTATE code for integrity constraint violations
                    $daysOfWeek = Carbon::getDays();
                    $dayName = $daysOfWeek[$day] ?? 'Unknown Day';
                    return back()->withErrors([
                        'time' => "The time slot {$validated['time']} already exists for $dayName.",
                    ]);
                }
                throw $e;
            }
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
