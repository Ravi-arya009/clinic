<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class
Clinic extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = [
        'id',
        'name',
        'slug',
        'phone',
        'whatsapp',
        'email',
        'contact_person',
        'contact_person_phone',
        'contact_person_whatsapp',
        'state_id',
        'city_id',
        'address',
        'pincode',
        'area',
        'speciality_id',
        'logo',
        'super_admin',

    ];

    public function admins()
    {
        return $this->belongsToMany(User::class, 'clinic_users')
        ->where('clinic_users.role_id', config('role.admin'));
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id', 'id')->select('id', 'name', 'image');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id')->select('id', 'name');
    }
}
