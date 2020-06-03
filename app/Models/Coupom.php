<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupom extends Model
{
    protected $table = 'coupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'start_date', 'end_date', 'type', 'value', 'quantity', 'active',
    ];

    public function order() 
    {
        return $this->belongsTo('App\Models\Order');
    }
}
