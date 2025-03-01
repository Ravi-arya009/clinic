<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Patient extends Authenticatable
{
    use HasUuids;
    protected $fillable = [
        'id',
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
        'password',
    ];

    //custom code to accomodate uuid
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $casts = [
        'id' => 'string',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id')->select('id', 'name');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id')->select('id', 'name');
    }

}
