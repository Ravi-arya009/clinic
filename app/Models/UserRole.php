<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasUuids;

    protected $fillable = [
        'id',
        'user_id',
        'role_id'
    ];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $casts = [
        'id' => 'string',
        'user_id' => 'string',
        'role_id' => 'string',
    ];
}
