<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdminRegister extends Component
{

    #[Validate('required|string|min:1|max:200')]
    public $name;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:8')]
    public $password;

    #[Validate('required|same:password')]
    public $password_confirmation;

    public function mount()
    {
        if (session('token') && session('admin')) {
            session()->flash('error', 'Already Logged in');
            $this->redirect(route('admin.dashboard'));
        }
    }
    public function register(){
       $data =  $this->validate();

       $response = Http::post('http://localhost:8001/api/admin/register',$data);

        if (isset($response['error'])){
            throw ValidationException::withMessages([
                'error' => [$response['error']]
            ]);
        }

        session()->flash('success', $response['message']);
        return $this->redirect(route('admin.login'),  navigate: true);
    }
    public function render()
    {
        return view('livewire.admin-register');
    }
}
