<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function getUserInfo(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('token'),
        ])->get('http://localhost:8001/api/user');

        return $response->json();
    }

    public function myOrder(Request $request){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('token'),
            'Accept' => 'application/json'
        ])->get('http://localhost:8001/api/order');

        if ($response->status() === 200) {
            return view('orders.index', ['data' => $response['data']]);
        } else {
            throw ValidationException::withMessages([
                'error' => [$response->json()['message'] ?? 'An error occurred while processing your order.']
            ]);
        }
    }
}
