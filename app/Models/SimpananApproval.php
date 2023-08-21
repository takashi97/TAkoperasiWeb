<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimpananApproval extends Model
{
    protected $table = "simpanan_approvals";
    protected $fillable = [
        'status',
        'note',
        // other fields that can be mass-assigned
    ];
}
