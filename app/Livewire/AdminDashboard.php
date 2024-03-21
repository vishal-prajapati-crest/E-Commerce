<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function mount()
    {
        if (!(session('token') && session('admin'))) {
            session()->flash('error', 'Not authenticated');
            $this->redirect(route('admin.login'));
        }
    }
    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
