<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AppointmentMedication extends Model
{
    use HasUuids;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $casts = [
        'id' => 'string',
    ];

    protected $fillable = [
        'id',
        'appointment_id',
        'medicine_name',
        'dosage',
        'duration',
        'instructions'
    ];
}
