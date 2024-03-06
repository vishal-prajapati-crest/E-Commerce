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
        $filters = request()->only('category','search'); //get category and search from request
        $query = Product::query() ; //craete a query instance
        $query_category = Product::query() ; //craete a query instance for to get unique categories available

        //check the category available in request if yes than filter data acoording to category
        if (isset($filters['category'])) {
            $query->where('category', 'LIKE', '%' . $filters['category'] . '%');
        }
        
        //check the search available in request if available than filter the data according to search
        if (isset($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'LIKE', '%' . $filters['search'] . '%') //if title match
                  ->orWhere('description', 'LIKE', '%' . $filters['search'] . '%')  //if description match
                  ->orWhere('category', 'LIKE', '%' . $filters['search'] . '%');// if category match
            });
        }

        $products = ProductResource::collection(
            $query->with('reviews')->withAvg('reviews', 'rating')->latest()->get()    
        );
        
            $categories = $query_category->select('category')->distinct()->get('category')->pluck('category');


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
