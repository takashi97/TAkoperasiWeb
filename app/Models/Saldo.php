<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    protected $table = "saldos";
    protected $fillable = [
        'saldo',
        // other fields that can be mass-assigned
    ];
}
