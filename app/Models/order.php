<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    
    public function user(){

        return $this->belongsTo(User::class);
    }
    public function orderItems(){

        return $this->hasMany(User::class);
    }
}
