<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInstallment extends Model
{
    protected $table = 'order_installments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'number', 'value', 'status_id', 'due_date'
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
    public function status()
    {
        return $this->hasOne('App\Models\PaymentStatus', 'id', 'status_id');
    }
}
