<?php

namespace App\Livewire\AdminDashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

class AddNewProduct extends Component
{
    #[Layout('components.layouts.dashboard')]
    public function render()
    {
        return view('livewire.admin-dashboard.add-new-product');
    }
}
