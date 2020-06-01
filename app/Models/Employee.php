<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Employee extends Authenticatable
{
    
    //protected $guard = 'admin';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password', 'position_id', 'role_id', 'active',
        // plus: fullAddress, telephone, birthday, etc...   
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the role for the employee.
     */
    public function role() 
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    /**
     * Get the position for the employee.
     */
    public function position() 
    {
        return $this->hasOne('App\Models\EmployeePosition', 'id', 'position_id');
    }

    /**
     * Get the stock for the item.
     */
    public function stock() 
    {
        return $this->hasMany('App\Models\Stock');
    }
}
