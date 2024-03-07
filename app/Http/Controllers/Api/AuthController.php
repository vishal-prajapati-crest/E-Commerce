<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function signup(Request $request){
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

        //fetch the data from database correspondence to this email user exists or not
        $user = \App\Models\User::where('email', $request->email)->first(); //fetch first data for this email

        //check wheaher user exist or not if not then create if exists then throw an error
        if($user){
            return response()->json(['error' => 'This e-mail is already registered.', 'data' =>  collect($data)->except('password')], 409);
        }

            $user = \App\Models\User::create($data);
            return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
        
    }

     //login method
     public function login(Request $request){
        
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
            return response()->json(['error' => 'The provided credentials are incorrect.', 'data' =>  collect($data)->except('password')], 401);
        }

        //Check the password provided is correct or not using hash check
        if(!Hash::check($request->password, $user->password)){
            return response()->json(['error' => 'The provided credentials are incorrect.', 'data' =>  collect($data)->except('password')], 401);
        }

        //Now user is geniun so genrate a token for that
        $token = $user->createToken('api-token')->plainTextToken; //using traits HasApiTokens which use in User model will create token and corvert it into plainText

        //send response in Json
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);

    }

    //logout method
    public function logout(Request $request){

        //delete token to logout
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);

    }
}
