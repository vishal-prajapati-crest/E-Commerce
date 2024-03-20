<?php

namespace App\Livewire;

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

    public function register(){
        dd('register');
    }
    public function render()
    {
        return view('livewire.admin-register');
    }
}
