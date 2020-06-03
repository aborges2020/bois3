<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'active',
    ];

    /**
     * Get the pos for the client.
     */
    public function pos() 
    {
        return $this->hasMany('App\Models\PointOfSale');
    }

    /**
     * Get the employees for the client.
     */
    public function employees() 
    {
        return $this->hasMany('App\Models\Employee');
    }

    /**
     * Get the employees for the client.
     */
    public function stocks() 
    {
        return $this->hasMany('App\Models\Stock');
    }

}
