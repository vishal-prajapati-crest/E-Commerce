<?php

namespace App\Livewire\AdminDashboard;

use Livewire\Component;

class Sidebar extends Component
{


    public function updated(){
        // dd($this->selected);
    }
    public function render()
    {
        return view('livewire.admin-dashboard.sidebar');
    }
}
