<?php

namespace App\Livewire\AdminDashboard;

use Livewire\Component;

class Sidebar extends Component
{

    public $selectedItem='addNewProduct';


    public function allProduct(){
        $this->selectedItem = 'allProduct';
    }
    
    public function addProduct(){
        $this->selectedItem = 'addNewProduct';
    }

    public function render()
    {
        return view('livewire.admin-dashboard.sidebar');
    }
}
