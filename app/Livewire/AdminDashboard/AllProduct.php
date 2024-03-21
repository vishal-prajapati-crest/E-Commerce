<?php

namespace App\Livewire\AdminDashboard;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;

#[Lazy]
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


    public function placeholder()
    {
        return <<<'HTML'
        <div class="spinner mt-10">
            <div class="min-h-6">
                <div class="">
                    <div class="container">
                        <div class="loadingspinner loadingspinner-large">
                            <div id="square1"></div>
                            <div id="square2"></div>
                            <div id="square3"></div>
                            <div id="square4"></div>
                            <div id="square5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }

    #[On('product-Removed')] 
    public function updateList(){
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

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->delete('http://localhost:8001/api/admin/product/'. $id);

        if($response->successful()){
            $this->dispatch('product-Removed'); 
            session()->flash('success','Removed successful');
        }else{
            session()->flash('error', $response['message']);
        }
    }

    #[Layout('components.layouts.dashboard')]
    public function render()
    {
        return view('livewire.admin-dashboard.all-product');
    }
}
