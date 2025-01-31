<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasUuids;
    protected $fillable = [
        'id',
        'name',
        'status'
    ];


    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $casts = [
        'id' => 'string',
    ];
}
