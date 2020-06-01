<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id', 'imageName', 'widget', 'active',
    ];

    public function product() 
    {
        return $this->belongsTo('App\Models\Product');
    }
}
