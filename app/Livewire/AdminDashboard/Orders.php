<?php

namespace App\Livewire\AdminDashboard;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Orders extends Component
{
    public $orders;

    public function mount(){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->get('http://localhost:8001/api/admin/orders');
        if($response->successful()){
            $this->orders = $response['data'];
        }
        
    }

    #[Layout('Components.layouts.dashboard')]
    public function render()
    {
        return view('livewire.admin-dashboard.orders');
    }
}
