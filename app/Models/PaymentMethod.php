<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'active', 'image'
    ];

    /**
     * Get the user that owns the client.
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    /**
     * Get the user that owns the client.
     */
    public function stock()
    {
        return $this->belongsTo('App\Models\Stock');
    }
}
