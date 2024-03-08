<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function checkExpiry(Request $request)
    {
        $user = $request->user();

        if (auth('sanctum')->check()) {
            return response()->json([
                'message' => 'Token is valid.',
                'expires_at' => $user->tokens()->where('name', 'api-token')->first()->expires_at,
            ]);
        } 
        return response()->json([
            'message' => 'Token is not valid or has expired.',
        ], 401);
    }
}
