<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[];
    public function orders(){
        $this->belongsToMany(Order::class,'order_items');
    }


}
