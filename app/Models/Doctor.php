<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory, HasUuids;
    //custom code to accomodate uuid
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $casts = [
        'user_id' => 'string',
    ];
    //custom code to accomodate uuid

    protected $fillable = ['user_id', 'experience', 'speciality_id', 'qualification_id', 'experience', 'consultation_fee', 'bio'];

    protected $forwardToUser = ['id', 'name', 'phone', 'whatsapp', 'email', 'gender', 'dob', 'password', 'clinic_id', 'state', 'city', 'address', 'pincode', 'timeSlots'];


    public function __get($key)
    {
        // First check if the attribute exists on the Doctor model
        $value = parent::__get($key);

        // If the attribute doesn't exist on Doctor but user is loaded
        if ($value === null && $this->relationLoaded('user') && $this->user) {
            // Return the attribute from the user model
            return $this->user->{$key};
        }

        return $value;
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }
    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class, 'doctor_id')->where('slot_type', 1)->orderBy('day_of_week')->orderBy('slot_time');
    }

    public function clinics()
    {
        return $this->hasMany(ClinicUser::class, 'user_id', 'user_id');
    }
}
