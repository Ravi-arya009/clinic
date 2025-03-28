<?php

namespace App\Services;

use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DateTime;
use Illuminate\Database\QueryException;

class TimeSlotService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return "this is index function";
    }

    public function getDoctorAvailableTimeSlots($doctorId)
    {
        $DoctorAvailableTimeSlots = TimeSlot::where('doctor_id', $doctorId)->where('slot_type', 1)->orderBy('slot_time', 'asc')->get()->groupBy('day_of_week');

        if (!$DoctorAvailableTimeSlots) {
            return [
                'success' => false,
                'message' => 'No Time Slots Found'
            ];
        }

        return $DoctorAvailableTimeSlots;
    }

    public function storeTimeSlot($data, $clinicId, $doctorId)
    {
        $data['time'] = DateTime::createFromFormat('h:i A', $data['time'])->format('H:i');

        foreach ($data['days'] ?? [] as $day) {
            try {
                TimeSlot::create([
                    'id' => Str::uuid(),
                    'slot_time' => $data['time'],
                    'day_of_week' => $day,
                    'doctor_id' => $doctorId,
                    'clinic_id' => $clinicId
                ]);
            } catch (QueryException $e) {

                if ($e->getCode() == 23000) { // 23000 is the SQLSTATE code for integrity constraint violations
                    $daysOfWeek = Carbon::getDays();
                    $dayName = $daysOfWeek[$day] ?? 'Unknown Day';
                    return [
                        'success' => false,
                        'message' => "The time slot {$data['time']} already exists for $dayName."
                    ];
                }
                throw $e;
            }
        }
        return [
            'success' => true,
            'message' => 'Time slots created successfully'
        ];
    }


    public function storeWalkInTimeSlot($clinicId, $doctorId)
    {
        try {
            $timeSlot = TimeSlot::create([
                'id' => Str::uuid(),
                'slot_time' => now()->format('H:i:s'),
                'day_of_week' => date('w'),
                'doctor_id' => $doctorId,
                'clinic_id' => $clinicId,
                'slot_type' => 2
            ]);

            return [
                'success' => true,
                'data' => [
                    'timeSlot' => $timeSlot,
                ],
                'message' => 'Clinic registered successfully!',
            ];
        } catch (QueryException $e) {
            throw $e;
            return [
                'success' => false,
                'message' => "Something went wrong while creating walkin time slot",
            ];
        }
    }

    public function deleteTimeSlot($slotId)
    {
        try {
            $slot = TimeSlot::find($slotId);

            if (!$slot) {
                return [
                    'success' => false,
                    'message' => 'Slot not found',
                ];
            }

            $slot->delete();
            return response()->json([
                'success' => true,
                'message' => 'Slot deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the slot',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
