<?php

namespace App\Livewire\AdminDashboard;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{

    public $selectedItem;

    public function mount(){
        $currentRoute = Route::currentRouteName();
        if($currentRoute==='admin.all-product'){
            $this->selectedItem = 'allProduct';
        }elseif($currentRoute==='admin.add-product'){
            $this->selectedItem = 'addNewProduct';
        }
    }


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
