<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinjamanApproval extends Model
{
    protected $table = "pinjaman_approvals";
    protected $fillable = [
        'status',
        'note',
        // other fields that can be mass-assigned
    ];
}
