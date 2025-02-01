<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AppointmentDetail extends Model
{
    use HasUuids;
    protected $primaryKey = 'appointment_id';
    public $incrementing = false;
    protected $casts = [
        'appointment_id' => 'string',
    ];

    protected $fillable = [
        'appointment_id',
        'notes',
        'advice',
    ];

}
