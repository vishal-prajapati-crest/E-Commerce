<?php

namespace App\Livewire\AdminDashboard;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Validate;
use Livewire\Component;


class AddNewProduct extends Component
{
    #[Validate('required|string|min:3|max:255')]
    public $title;

    #[Validate('required|numeric')]
    public $price;

    #[Validate('required|string|min:10|max:1000')]
    public $description;

    #[Validate('required|string|min:2|max:255')]
    public $category;

    #[Validate('required|url|active_url')]
    public $image;

public function save(){
    $data = $this->validate();
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . session('token'),
        'Accept' => 'application/json'
    ])->post('http://localhost:8001/api/admin/add-product', $data);

if($response->successful()){
        session()->flash('success', $response['message']);
        $this->reset();
    }else{
        session()->flash('error', $response['error']);
        throw ValidationException::withMessages([
            'error' => [$response['message']]
        ]);
    }
}

    #[Layout('components.layouts.dashboard')]
    public function render()
    {
        return view('livewire.admin-dashboard.add-new-product');
    }
}
