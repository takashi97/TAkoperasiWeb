<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenarikanApproval extends Model
{
    protected $table = "penarikans_approvals";
    protected $fillable = [
        'status',
        'note',
        // other fields that can be mass-assigned
    ];
}
