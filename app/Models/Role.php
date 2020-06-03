<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * Get the user that owns the client.
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'role_id', 'id');
    }

    
}
