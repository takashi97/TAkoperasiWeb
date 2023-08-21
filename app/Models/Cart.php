<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_product')->withPivot('quantity');
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->products as $product) {
            $totalPrice += $product->h_produk * $product->pivot->quantity;
        }

        return $totalPrice;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
