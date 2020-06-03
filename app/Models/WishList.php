<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wish_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'name', 'email', 'sending_status', 
    ];

    
    public function product() 
    {
        return $this->belongsTo('App\Models\Product');
    }
}
