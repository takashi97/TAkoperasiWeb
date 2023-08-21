<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = "pinjamans";
    protected $fillable = [
        'name',
        'jum_pinjaman',
        'dur_pinjaman',
        't_pinjaman'
        // other fields that can be mass-assigned
    ];
}
