<?php

namespace App\Livewire\AdminDashboard;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AllProduct extends Component
{
    public $products;
    public $loading = false;
    public function mount(){
        $this->loading = true;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get('http://localhost:8001/api/admin/products');
        if($response->successful()){
            $this->products = $response['data'];
        }

        $this->loading = false;
    }

    public function delete(int $id){
        dd('inside delete');
    }

    #[Layout('components.layouts.dashboard')]
    public function render()
    {
        return view('livewire.admin-dashboard.all-product');
    }
}
