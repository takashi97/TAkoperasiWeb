<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = [
        'p_name',
        'image_produk',
        'j_produk',
        'h_produk',
        'k_produk',
        's_produk',
        'b_produk',
        'd_produk',
        'identifier',

        // other fields that can be mass-assigned
    ];

    public function cart() 
    {
        return $this->belongsTo(Cart::class, 'products');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
