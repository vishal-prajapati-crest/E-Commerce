<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',function(){
    return response()->json(["Api E-Commerce Application"]);
});

Route::post('/auth/login', [AuthController::class, 'login'])->name('api.auth.login');
Route::post('/auth/signup', [AuthController::class, 'signup'])->name('api.auth.signup');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('products',ProductController::class)->only(["index","show"])->names('api.products');

Route::get('/token/check-expiry', [TokenController::class, 'checkExpiry'])->middleware('auth:sanctum');

Route::apiResource('/order',OrderController::class)->middleware('auth:sanctum')->only(['index','store'])->names('api.order');

Route::controller(AdminController::class)->prefix('admin')->name('api.admin.')->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login','adminLogin')->name('login');
    Route::post('/logout','adminLogout')->middleware('auth:sanctum')->name('logout');
});
