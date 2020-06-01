<?php

namespace App\Http\Controllers\Site\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    /**
     * Show all categories.
     */
    public function allCategories()
    {
        return view('site.shop.allCategories');
    }
    
    /**
     * Show all products.
     */
    public function allProducts()
    {
        return view('site.shop.allProducts');
    }

    /**
     * Show all products of category.
     */
    public function productsByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where([['id', $category->id], ['active', 1]])->get();
                
        $seoTitle       = $category->categoryName;
        $seoDescription = $category->seoDescription;

        return view('site.shop.productsByCategory', ['category' => $category, 'products' => $products, 'seoTitle' => $seoTitle, 'seoDescription' => $seoDescription]);
    }
    
    /**
     * Show product.
     */
    public function product($category, $slug)
    {
        $product = Product::where(['slug' => $slug])->firstOrFail();
        
        $seoTitle       = $product->productName;
        $seoDescription = $product->seoDescription;

        return view('site.shop.product', ['product' => $product, 'seoTitle' => $seoTitle, 'seoDescription' => $seoDescription]);
    }    
}
