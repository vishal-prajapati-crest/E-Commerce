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
                'message' => 'Failed to add product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
