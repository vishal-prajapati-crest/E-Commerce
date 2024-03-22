<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Auth.Login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate the data
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $response = Http::post('http://localhost:8001/api/auth/login/', $data);

        
        if ($response->successful()) {
            session()->invalidate();
            session()->regenerate();
            $token = $response['token']; // Assuming the token key in the response is 'token'
            $user = $response['user']; // Assuming the user key in the response is 'user'
            // Store the token in the session
            Session::put('token', $token);
            Session::put('user', $user);
            
            return redirect()->route('products.index')->with('success','Login successful');
            

        } else {
            throw ValidationException::withMessages([
                'error' => [$response['error']]
            ]);
        }
    }

    public function logout(Request $request)
    {
        // $request->user()->currentAccessToken()->delete();
    
        // // Remove user data from the session
        // $request->session()->forget('user');
        // $request->session()->forget('token');
        // Auth::logout();

        
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->post('http://localhost:8001/api/logout');

        if($response->successful()){
            //destroy the session
        request()->session()->invalidate();


        //regenrate the seesion token for csrf
        request()->session()->regenerateToken();
        }else{
            throw ValidationException::withMessages([
                'error' => [$response['error']]
            ]);
        }
        

        // return redirect('/');
    
        return redirect()->route('products.index')->with('success', 'Logout successful');
    }
    
}
