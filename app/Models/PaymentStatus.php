<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $table = 'payment_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active',
    ];

    /**
     * Get the order.
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    /**
     * Get the stock.
     */
    public function stock()
    {
        return $this->belongsTo('App\Models\Stock');
    }

    /**
     * Get the installment.
     */
    public function installment()
    {
        return $this->belongsTo('App\Models\OrderInstallment');
    }

}
