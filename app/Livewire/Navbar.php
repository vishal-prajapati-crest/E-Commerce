<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Navbar extends Component
{

    public function AdminLogout(){
          
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->post('http://localhost:8001/api/admin/logout');

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
        session()->flash('success', $response['message']);
        return $this->redirect('/admin/login',  navigate: true);
    }
    public function render()
    {
        return view('livewire.navbar');
    }
}
