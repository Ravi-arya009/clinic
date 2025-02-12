<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasUuids;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $casts = [
        'id' => 'string',
    ];

    protected $fillable = [
        'id',
        'patient_id',
        'doctor_id',
        'clinic_id',
        'time_slot_id',
        'appointment_date',
        'payment_method'
    ];

    public function patient(){
        return $this->belongsTo(Patient::class)->select('id','name','phone','email','address','gender');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'phone', 'email');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class)->select('id','name', 'address');
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class)->select('id', 'slot_time');
    }

    public function appointmentDetails(){
        return $this->hasOne(AppointmentDetail::class);
    }

    public function medications(){
        return $this->hasMany(AppointmentMedication::class);
    }
    public function labTests()
    {
        return $this->hasMany(AppointmentLabTest::class);
    }
}
