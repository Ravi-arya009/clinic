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


    protected $fillable = [
        'user_id',
        'experience',
        'speciality_id',
        'qualification_id',
        'consultation_fee',
        'bio'
    ];

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }
    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
}
