<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    protected $table = 'employee_positions';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active',
    ];

    /**
     * Get the user that owns the client.
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'position_id', 'id');
    }
}
