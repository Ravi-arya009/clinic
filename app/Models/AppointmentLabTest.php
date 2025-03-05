<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AppointmentLabTest extends Model
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
        'lab_test_id',
    ];

    public function labTests()
    {
        return $this->belongsTo(LabTestMaster::class,'lab_test_id');
    }

    // public function medicine()
    // {
    //     return $this->belongsTo(MedicineMaster::class, 'medicine_id');
    // }
}
