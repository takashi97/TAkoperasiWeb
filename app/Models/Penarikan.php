<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    protected $table = "penarikans";
    protected $fillable = [
        'name',
        'jum_penarikan',
        't_penarikan',
        'approved',
        // other fields that can be mass-assigned
    ];
}
