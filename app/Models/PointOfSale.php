<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointOfSale extends Model
{
    protected $table = 'point_of_sales';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'active','store_id', 'employee_id', 
    ];

    /**
     * Get the stores that owns the point of sale.
     */
    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    /**
     * Get the employee that owns the point of sale.
     */
    // public function employee()
    // {
    //     return $this->hasOne('App\Models\Employee');
    // }    
}
