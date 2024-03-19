<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasFactory;
    use HasApiTokens;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}