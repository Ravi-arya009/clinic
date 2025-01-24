<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Clinic extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $casts = [
        'id' => 'string',
    ];

    protected $fillable = [
        'id',
        'name',
        'slug',
        'phone',
        'contact_person',
        'contact_person_phone',
        'admin_name',
        'admin_phone',
        'admin_password',
        'super_admin',
        'state',
        'city',
        'area',
        'address',
        'speciality_id'

    ];

    public function admin()
    {
        return $this->hasOne(User::class, 'clinic_id', 'id')->select('id', 'name', 'phone', 'clinic_id');
    }
    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id', 'id')->select('id','name');
    }
}
