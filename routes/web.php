<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserController;
use App\Livewire\Admin;
use App\Livewire\AdminDashboard;
use App\Livewire\AdminDashboard\AddNewProduct;
use App\Livewire\AdminDashboard\AllProduct;
use App\Livewire\AdminDashboard\Orders;
use App\Livewire\AdminLogin;
use App\Livewire\AdminRegister;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('products.index');
});

Route::resource('products', ProductController::class)->middleware('verifyToken')->only(['index','show']);
Route::resource('create', SignupController::class)->only(['index','store']);

Route::get('login', fn () => to_route('auth.create'))->name('login');
Route::resource('auth',AuthController::class)->only(['create', 'store']);

Route::get('/user-info',  [UserController::class, 'getUserInfo']);
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::post('/cart/add', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::get('/cart', 'App\Http\Controllers\CartController@show')->name('cart.show');
Route::post('/cart/remove', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::post('/cart/update', 'App\Http\Controllers\CartController@update')->name('cart.update');

Route::resource('checkout', CheckoutController::class)->middleware('verifyToken')->only(['create','store']);

Route::get('/my-order', [UserController::class, 'myOrder'])->name('myOrder');


Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/', AdminLogin::class)->name('home');
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/register', AdminRegister::class)->name('Register');
    Route::get('/login', AdminLogin::class)->name('login');

    Route::get('/add-product', AddNewProduct::class)->name('add-product');
    Route::get('/all-product', AllProduct::class)->name('all-product');
    Route::get('/orders', Orders::class)->name('orders');
});
