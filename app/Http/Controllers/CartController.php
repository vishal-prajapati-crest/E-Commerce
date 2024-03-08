<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{

    public function show()
    {
        return view('cart.index');
    }


    public function add(Request $request)
    {

            // Get the token from the session
            $token = session('token');

            // Check if the token is available
            if (!$token) {
                return redirect()->back()->with('error', 'You must be logged in to add items to the cart.');
            }

            $productId = $request->input('product_id');
            $response = Http::get('http://127.0.0.1:8001/api/products/'. $productId);
                $data = json_decode($response);
                $product = $data->data;
            // $product = Product::find($productId);

            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }

            $cart = session()->get('cart');

            // If cart is empty, initialize it as an empty array
            if (!$cart) {
                $cart = [];
            }

            // Check if the product is already in the cart
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity']++;
            } else {
                $cart[$productId] = [
                    'id' => $product->id,
                    'title' => $product->title,
                    'price' => $product->price,
                    'quantity' => 1,
                    'image' => $product->image,
                ];

            }

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');

        $cart = session()->get('cart');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'Product removed from cart.');
    }

    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $action = $request->input('action');

        $cart = session()->get('cart');

        if (isset($cart[$productId])) {
            if ($action === 'increase') {
                $cart[$productId]['quantity']++;
            } elseif ($action === 'decrease' && $cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            }

            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show');
    }
}
