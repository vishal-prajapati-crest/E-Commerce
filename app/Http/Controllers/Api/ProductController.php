<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Product::query() ; //craete a query instance
        $products = ProductResource::collection($query->latest()->get());
        $categories = $query->distinct()->get('category')->pluck('category');

return response()->json([
    'categories' => $categories,
    'products' => $products,
]);
        // return ProductResource::collection($query->latest()->get()); //conver into collection i.e. json {data:[{},{},...]} without paginate
        // return ProductResource::collection($query->latest()->paginate()); //conver into collection i.e. json {data:[{},{},...]}
    }

   

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return ProductResource::make($product);
    }

}
