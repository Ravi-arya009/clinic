<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'phone',
        'whatsapp',
        'email',
        'gender',
        'dob',
        'password',
        'clinic_id',
        'state_id',
        'city_id',
        'address',
        'pincode'
    ];


    //custom code to accomodate uuid
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $casts = [
        'id' => 'string',
    ];
    //custom code to accomodate uuid

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class, 'doctor_id')->orderBy('day_of_week')->orderBy('slot_time');
    }

    public function doctorProfile()
    {
        return $this->hasOne(Doctor::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id')->select('id', 'name');
    }
    public function clinicRole(){
        return $this->hasMany(ClinicUser::class, 'user_id', 'id');
    }
}
