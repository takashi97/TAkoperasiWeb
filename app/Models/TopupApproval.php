<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopupApproval extends Model
{
    protected $table = "topups_approvals";
    protected $fillable = [
        'status',
        'note',
        // other fields that can be mass-assigned
    ];
}