<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function register(Request $request){
        //validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        
        // If validation passes, continue with your logic
        $data = $validator->validated();

        //fetch the data from database correspondence to this email user or admin exists or not
        $user = \App\Models\User::where('email', $request->email)->first(); //fetch first data for this email

        //check wheather user exist or not if not then create if exists then throw an error
        if($user){
            return response()->json(['error' => 'This e-mail is already registered with admin or user.', 'data' =>  collect($data)->except('password')], 409);
        }

            $user = \App\Models\User::create($data);
            $admin = $user->admin()->create();
            return response()->json(['message' => 'Admin created successfully', 'user' => $user, 'admin' => $admin], 201);
        
    }

    public function adminLogin(Request $request){
        
        //validate data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',  //email is required and it should be typeof email
            'password' => 'required' //Password must be there
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // If validation passes, continue with your logic
        $data = $validator->validated();

        //fetch the data from database correspondence to this email
        $user = \App\Models\User::where('email', $request->email)->first(); //fetch first data for this email

        //check wheaher user exist or not if not then throw validation error
        if(!$user){
            return response()->json(['success' => false ,'error' => 'The provided credentials are incorrect.', 'data' =>  collect($data)->except('password')], 401);
        }

        $admin = $user->admin()->first();

        if(!$admin){
            return response()->json(['success' => false ,'error' => 'The provided credentials user is not an admin.', 'data' =>  collect($data)->except('password')], 401);
        }

        //Check the password provided is correct or not using hash check
        if(!Hash::check($request->password, $user->password)){
            return response()->json(['success' => false ,'error' => 'The provided credentials are incorrect.', 'data' =>  collect($data)->except('password')], 401);
        }

        //Now user is geniun so genrate a token for that
        $token = $admin->createToken('api-token',['*'],now()->addMinutes(1440))->plainTextToken; //using traits HasApiTokens which use in User model will create token and corvert it into plainText

        //send response in Json
        return response()->json([
            'token' => $token,
            'message' => "Login successfully",
            'user' => $user,
            'admin' => true
        ]);

    }

    public function adminLogout(Request $request){

        //delete token to logout
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);

    }

    public function addProduct(Request $request){
        try{
            $admin = $request->user();

            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'required|min:10',
                'category' => 'required|string',
                'image' => 'required|string'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' =>false,
                    'message' => 'Validation fails',
                    'error' => $validator->errors()
                ], 422);
            }

            // If validation passes, continue with your logic
             $data = $validator->validated();

            $product = $admin->products()->create($data);

            if($product){
                return response()->json([
                    'success' => true,
                    'message' => 'Product added successfully',
                    'data' => $product
                ],201);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Product not added',
                    'error' => 'Product does not created'
                ], 500);
            }
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAllProducts(Request $request){
        try{
            $admin = $request->user();
            $product = $admin->products()->latest()->get();

            if($product){
                return response()->json([
                    'message' => 'Product fetch successfully',
                    'data' => $product
                ],200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch product',
                    'error' => 'unable to get product'
                ], 500);
            }
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteProduct(Request $request,int $id){
        try{

            $seller = $request->user();

            $product = $seller->products()->where('id',$id)->first();

            if($product){
                $deleted = $product->delete();
                if($deleted){
                    return response()->json([
                        'message' => 'Product deleted successfully',
                    ], 200);
                }else{
                    throw new Exception("Unable to delete product", 500);                
                }
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete product',
                'error' => $e->getMessage()
            ], 500);
        }
        
        
    }

    public function getOrders(Request $request){
        try {
            $seller = $request->user();
           
            $productWithOrderDetail = $seller->products()->select('id','title','category','image')
                ->whereHas('orderItems', function ($query) {
                    $query->where('quantity', '>', 0); // Assuming 'quantity' is the column indicating the number of items in an order
                })
                ->with(['orderItems' => function ($query) {
                    $query->with(['order' => function ($query) {
                        $query->select('id', 'user_id', 'payment_status', 'address', 'state', 'city', 'country');
                    }])->with(['order.user' => function($query){
                        $query->select('id', 'name', 'email');
                    }]);
                }])
                ->withCount('orderItems')
                ->get();

            if($productWithOrderDetail){
                return response()->json([
                    'message' => 'Order fetched successfully',
                    'data' => $productWithOrderDetail
                ]);
            }else{
                return response()->json([
                    'message' => 'No order found'
                ]);
            }

            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to Fetch Orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function editProduct(Request $request, int $id){
        try{
            $seller = $request->user();
            $product = $seller->products()->where('id',$id)->first();

            if (!$product){
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found or you dont own this product',
                    'error' => 'Product not found or you dont own this product'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'required|min:10',
                'category' => 'required|string',
                'image' => 'required|string'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' =>false,
                    'message' => 'Validation fails',
                    'error' => $validator->errors()
                ], 422);
            }

            // If validation passes, continue with your logic
             $data = $validator->validated();

            $product = $seller->products()->where('id',$id)->update($data);

            if($product){
                return response()->json([
                    'message' => "Updated successfully"
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Not updated',
                    'error' => 'Unable to update somthing went wrong'
                ],400);
            }
            
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to Fetch Orders',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
