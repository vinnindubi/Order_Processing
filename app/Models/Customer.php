<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{ use HasApiTokens;
    protected $fillable=['name','phone_number'];
    protected $casts =[
        'password'=>'hashed'
     ];
     public function orders(){
        return $this->hasMany(Order::class);
        
     }
     public function orderItems(){
        return $this->hasManyThrough(OrderItem::class,Order::class);
     }

     
}
