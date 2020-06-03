<?php

namespace App\Http\Controllers\Site\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models\Category;
use App\Models\Product;


class MenuController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCategories()
    {
        //$data = Category::where('active', 1)->get();
        $categories = Category::select('categoryName', 'slug', 'description', 'subCategory')->where('active', 1)->get();
        
        //return response()->json(['categories' => $data]);
        
        return Response::json($categories);
    }
    
    // public function getProducts()
    // {
    //     $data = Product::select('categoryName', 'slug', 'description', )->where('active', 1)->get();
        
    //     return response()->json(['result' => $data]);
    // }
    
}
