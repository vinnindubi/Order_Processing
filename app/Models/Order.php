<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[];
    public function products(){
        $this->belongsToMany(Product::class,'order_items');
    }
}
