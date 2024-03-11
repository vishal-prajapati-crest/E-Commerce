<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function reviews(){

        return $this->hasMany(Review::class);
    }
    public function orderItems(){

        return $this->hasMany(order_items::class);
    }
}
