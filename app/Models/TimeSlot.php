<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasUuids;

    protected $fillable = [
        'id',
        'doctor_id',
        'clinic_id',
        'slot_time',
        'day_of_week',
        'slot_type',
        'status',
    ];

    //custom code to accomodate uuid
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $casts = [
        'id' => 'string',
    ];
    //custom code to accomodate uuid

}
