<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['quantity','amount','customer_id','payment_id','payment_status'];
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
