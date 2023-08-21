<?php

namespace App\Models;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'cart_id',
        'shipping_id',
        'alamat_kirim',
        't_tagihan',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

}
