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
        'dependant_id',
        'doctor_id',
        'clinic_id',
        'time_slot_id',
        'appointment_date',
        'booking_for',
        'appointment_type',
        'payment_method'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'phone', 'whatsapp', 'email', 'gender', 'profile_image');
    }


    public function clinic()
    {
        return $this->belongsTo(Clinic::class)->select('id', 'name', 'phone', 'email', 'whatsapp', 'address');
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class)->select('id', 'slot_time');
    }

    public function appointmentDetails()
    {
        return $this->hasOne(AppointmentDetail::class);
    }

    public function medications()
    {
        return $this->hasMany(AppointmentMedication::class);
    }
    public function labTests()
    {
        return $this->hasMany(AppointmentLabTest::class);
    }
    public function dependant()
    {
        return $this->belongsTo(dependant::class);
    }
    public function billing(){
        return $this->hasOne(Billing::class);
    }
}
