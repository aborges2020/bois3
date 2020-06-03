<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $table = 'shipping_methods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'active', 'cost', 'image'
    ];

    /**
     * Get the user that owns the client.
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
