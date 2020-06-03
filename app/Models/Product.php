<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'productName', 'description', 'slug', 'seoDescription', 'active', 'price',  'image', 'supplier_id', 'quantity'
    ];

    /**
     * Get the supplier for the product.
     */
    public function supplier() 
    {
        return $this->belongsTo('App\Models\ProductSupplier')->orderByDesc('id');
    }

    /**
     * Get the wishList for the product.
     */
    public function wishList() 
    {
        return $this->hasMany('App\Models\WishList')->orderByDesc('id');
    }

    /**
     * Get the images for the product.
     */
    public function images() 
    {
        return $this->hasMany('App\Models\ProductImage')->orderByDesc('id');
    }

    public function category() 
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get the item that owns the product.
     */
    public function item()
    {
        return $this->belongsTo('App\Models\OrderItem');
    }

    /**
     * Get the item that owns the product.
     */
    public function stockItem()
    {
        return $this->belongsTo('App\Models\StockItem');
    }
}
