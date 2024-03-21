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
        $this->redirect(route('admin.all-product'), navigate:true);
    }
    
    public function addProduct(){
        $this->selectedItem = 'addNewProduct';
        $this->redirect(route('admin.add-product'), navigate:true);
    }

    public function render()
    {
        return view('livewire.admin-dashboard.sidebar');
    }
}
