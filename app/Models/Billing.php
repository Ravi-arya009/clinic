<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
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
        'amount_to_be_paid',
        'amount_paid',
        'payment_status',
        'payment_method',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
