<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $table = "topups";
    protected $fillable = [
        'name',
        'jum_topup',
        't_topup',
        'image_topup',
        'approved',
        // other fields that can be mass-assigned
    ];
}
