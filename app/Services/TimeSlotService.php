<?php

namespace App\Services;

use App\Models\TimeSlot;

class TimeSlotService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index(){
        return "this is index function";
    }
    public function getDoctorAvailableTimeSlots($doctorId)
    {
        $DoctorAvailableTimeSlots = TimeSlot::where('doctor_id', $doctorId)->orderBy('slot_time', 'asc')->get()->groupBy('day_of_week');
        return $DoctorAvailableTimeSlots;
    }
}
