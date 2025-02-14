<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasUuids;

    protected $fillable = [
        'role_id',
        'role_name',
    ];


    protected $primaryKey = 'role_id';
    public $incrementing = false;
    protected $casts = [
        'role_id' => 'string',
    ];
}
