<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ClinicWorkingHour extends Model
{
    use HasUuids;
    protected $fillable = [
        'id',
        'clinic_id',
        'day',
        'shift',
        'opening_time',
        'closing_time',
        'is_active'
    ];


    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $casts = [
        'id' => 'string',
    ];
}
