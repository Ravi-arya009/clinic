<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{

    protected $fillable = [
        'doctor_id',
        'clinic_id',
        'slot_time',
        'day_of_week',
        'status',
    ];
}
