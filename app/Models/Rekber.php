<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Rekber extends Model
{
    protected $table = 'rekbers';
    protected $fillable = [
        'rekber_saldo',

        // other fields that can be mass-assigned
    ];
}
