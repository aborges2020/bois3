<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price'
    ];

    /**
     * Get the user that owns the client.
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function products() // ou orderItems ???
    {
        return $this->hasMany('App\Models\Product', 'id', 'product_id');
    }
}
