<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Address extends Model
{
    use SoftDeletes;

    protected $table = 'adresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'address', 'number', 'city', 'state', 'country', 'primaryAddress',
    ];

    /**
     * Get the user that owns the client.
     */
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
