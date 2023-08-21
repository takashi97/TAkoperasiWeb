<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class KoperasiSaldocontrol extends Model
{
    protected $table = "koperasi_saldocontrol";
    protected $fillable = [
        'saldo_control',
        // other fields that can be mass-assigned
    ];
}
