<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{ use HasFactory;
    protected $fillable=['name','stock','price','description'];
    public function order_items(){
        return $this->hasMany(Order::class);
    }
}
