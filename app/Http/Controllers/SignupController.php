<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Auth.signup');
    }

  
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate the data
        $data = $request->validate([
            'name' => 'required|string|min:1|max:200',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ]);

        $response = Http::post('http://localhost:8001/api/auth/signup',$data);

        if (isset($response['error'])){
            throw ValidationException::withMessages([
                'error' => [$response['error']]
            ]);
            // return redirect()->back()->with('error', $response['error']);
        }

        return redirect()->route('login')->with('success','Registered Sucessfully');
        // dd($response->status());

    }

}
