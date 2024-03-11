<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!session()->has('cart') || empty(session('cart'))){
            // Redirect the user back to the previous page with a error message
            return redirect()->back()->with('error', 'Your cart is empty.');
        }
        return view('checkout.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!session()->has('cart') || empty(session('cart'))){
            // Redirect the user back to the previous page with a error message
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $validatedData = $request->validate([
            'address' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'card_number' => 'required|numeric|digits_between:15,16',
            'card_expire' => 'required|date_format:m/y|after_or_equal:today',
            'card_cvv' => 'required|numeric|digits:3',
            'card_name' => 'required|string',
        ]);
        
        $orderItems = session('cart');

       
        $orderItemsData = [];
        foreach ($orderItems as $item) {
            $id = $item['id'];
            $title = $item['title'];
            $price = $item['price'];
            $quantity = $item['quantity'];

            // Restructure the order item data
            $orderItemsData[] = [
                $id => 
                    [
                        ['id' => $id],
                        ['title' => $title],
                        ['price' => $price],
                        ['quantity' => $quantity]
                    ]
                
            ];
        }

        $total_amount = 0;
        
        foreach ($orderItems as $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }

        $data = [
            'address' => $validatedData['address'],
            'country' => $validatedData['country'],
            'state' => $validatedData['state'],
            'city' => $validatedData['city'],
            'total_amount' => $total_amount,
            'payment_status' => true, // Assuming payment is successful if form is submitted
            'transaction_id' => uniqid(), // Generate a unique transaction ID
            'order_item' => $orderItemsData,
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json'
        ])->post('http://localhost:8001/api/order', $data);

        if ($response->status() === 201) {
            session()->forget('cart');
            return redirect()->route('products.index')->with('success', $response->json()['message'] ?? 'Order placed successfully.');
        } else {
            throw ValidationException::withMessages([
                'error' => [$response->json()['message'] ?? 'An error occurred while processing your order.']
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
