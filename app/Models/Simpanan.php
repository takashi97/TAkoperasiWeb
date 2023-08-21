<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $table = "simpanans";
    protected $fillable = [
        'name',
        'user_id',
        'j_simpanan',
        'jum_simpanan',
        't_simpanan',
        'approved',
        // other fields that can be mass-assigned
    ];
}
