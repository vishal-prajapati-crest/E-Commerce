<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AdminDashboard extends Component
{
    
    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
