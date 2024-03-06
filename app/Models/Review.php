<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['review','rating']; // make mass assignment data enable to the fields in array

    public function product(){

        return $this->belongsTo(Product::class);
    }
}
