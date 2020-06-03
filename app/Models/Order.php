<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'status_id', 'payment_id', 'shipping_id', 'shipping_value', 'coupom_id', 'discount_value', 'total', 'point_of_sale', 'employee_id', 'ip'
    ];

    /**
     * Get the client method that owns the order.
     */
    public function client()
    {
        return $this->BelongsTo('App\Models\Client');
    }

    /**
     * Get the status method that owns the order.
     */
    public function status()
    {
        return $this->hasOne('App\Models\PaymentStatus', 'id', 'status_id');
    }

    /**
     * Get the payment method that owns the order.
     */
    public function payment()
    {
        return $this->hasOne('App\Models\PaymentMethod', 'id', 'payment_id');
    }

    /**
     * Get the shipping method that owns the order.
     */
    public function shipping()
    {
        return $this->hasOne('App\Models\ShippingMethod', 'id', 'shipping_id');
    }

    /**
     * Get the pos method that owns the order.
     */
    public function pos()
    {
        return $this->hasOne('App\Models\PointOfSale', 'id', 'point_of_sale_id');
    }

    /**
     * Get the employee method that owns the order.
     */
    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }  

    /**
     * Get the items method that owns the order.
     */
    public function items() // ou orderItems ???
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    /**
     * Get the installments method that owns the order.
     */
    public function installments() // ou orderItems ???
    {
        return $this->hasMany('App\Models\OrderInstallment');
    }

    /**
     * Get the installments method that owns the order.
     */
    public function coupom() // ou orderItems ???
    {
        return $this->hasOne('App\Models\Coupom', 'id', 'coupom_id');
    }

}
