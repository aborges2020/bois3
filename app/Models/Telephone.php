<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Telephone extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'number', 'primaryTelephone',
    ];

    /**
     * Get the user that owns the client.
     */
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
