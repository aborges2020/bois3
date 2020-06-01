<?php

namespace App\Http\Controllers\Site\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models\Product;
use App\Models\Category;

class ProductsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $shopProducts = Product::with('category:id,categoryName,slug')->select('id','productName', 'slug', 'description', 'image', 'price', 'category_id', 'quantity')->where([['active', 1]])->get();
        
        return Response::json($shopProducts);
    }  
}
