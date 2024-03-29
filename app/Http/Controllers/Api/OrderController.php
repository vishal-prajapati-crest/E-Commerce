<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Mail\OrderPlaced;
use App\Models\order;
use App\Models\order_items;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $user = $request->user();
            $orders = $user->orders()->with('orderItems.product')->latest()->get();
            if($orders->count()){
                return response()->json([
                    'data'=> $orders,
                    'message' => 'Order founded successfully!!'
                ]);
            }else{
                return response()->json([
                    'message'=> 'Order Not Found'
                ],404);
            }
            
        }catch(\Exception $e){
            // If an error occurs, return an error response
            return response()->json([
                'message' => 'Failed to fetch orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $user = $request->user();
            $order = $user->orders()->create([
                'total_amount' => $request['total_amount'],
                'payment_status' => $request['payment_status'],
                'transaction_id' => $request['transaction_id'],
                'address' => $request['address'],
                'state' => $request['state'],
                'city' => $request['city'],
                'country' => $request['country']
            ]);

            foreach ($request['order_item'] as  $item) {


                $productData = reset($item); // Get the product data array it will reset the key

                $id = $productData[0]['id'];
                $price = $productData[2]['price'];
                $quantity = $productData[3]['quantity'];
                $order->orderItems()->create([
                    'product_id' => $id,
                    'quantity' => $quantity,
                    'price' => $price
                ]); 
            }

            $order->load('orderItems.product'); //load the order items

            //send order placed mail
            Mail::to($request->user())->send(new OrderPlaced($order));


            return response()->json(
            [
                'message' => "Order Placed Successfully! your order id is ". $order['id'],
                'data' => $order
            ], 
            201
            );
        }catch(\Exception $e){
            // If an error occurs, return an error response
            return response()->json([
                'message' => 'Failed to place order',
                'error' => $e->getMessage()
            ], 500);
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
