<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'contact_name', 'email', 'tel_number', 'cel_number', 'description', 'active',
        //Add: address, number, city, state, country 
    ];

    /**
     * Get the adress for the client.
     */
    public function products() 
    {
        return $this->hasMany('App\Models\Products');
    }

    /**
     * Get the stock for the supplier.
     */
    public function stock() 
    {
        return $this->belongsTo('App\Models\Stock');
    }

}
