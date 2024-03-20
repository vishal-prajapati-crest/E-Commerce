<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdminLogin extends Component
{
    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:8')]
    public $password;

  
    
    public function login(){
        $this->validate();

        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post('http://localhost:8001/api/admin/login', ["email" => $this->email, "password" => $this->password]);
        
        //if response is successful
        if($response->successful()){
            $token = $response['token']; // Assuming the token key in the response is 'token'
            $user = $response['user']; // Assuming the user key in the response is 'user'
            $admin = $response['admin']; //it will return true if user is admin
            $message = $response['message']; //get message

            // Store the token in the session
            Session::put('token', $token);
            Session::put('user', $user);
            Session::put('admin', $admin);
            session()->flash('success', $message);
            return $this->redirect('/admin/dashboard',  navigate: true);
            
        }else{
            throw ValidationException::withMessages([
                'error' => [$response['error']]
            ]);
        }
    }

   
    

    public function render()
    {
        return view('livewire.admin-login');
    }
}
