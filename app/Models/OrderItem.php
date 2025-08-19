<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable=['order_id','product_id','quantity','total_amount','no_goods'];
    public function order(){
       return $this->belongsTo(Order::class); 
    }
    public function products(){
       return $this->belongsTo(Order::class);
    }
}
