<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{

    use HasUuids;
    protected $fillable = [
        'id',
        'patient_id',
        'name',
        'phone',
        'whatsapp',
        'email',
        'gender',
        'dob',
        'state_id',
        'city_id',
        'address',
        'pincode',
        'profile_image',
    ];

    //custom code to accomodate uuid
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $casts = [
        'id' => 'string',
    ];
}
