<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function getUserInfo(Request $request)
{
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . Session::get('token'),
    ])->get('http://localhost:8001/api/user');

    return $response->json();
}
}
