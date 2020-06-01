<?php

namespace App\Http\Controllers\Site\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $shopCategories = Category::select('categoryName', 'slug', 'description', 'subCategory', 'image')->where('active', 1)->get();
        
        return Response::json($shopCategories);
    }
}
