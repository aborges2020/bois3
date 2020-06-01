<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password', 'active', 'image'
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
     * Get the adress for the client.
     */
    public function adresses() 
    {
        return $this->hasMany('App\Models\Address')->orderByDesc('id');
    }

    /**
     * Get the adress for the client.
     */
    public function telephones()
    {
        return $this->hasMany('App\Models\Telephone')->orderByDesc('id');
    }

    /**
     * Get the adress for the client.
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order')->orderByDesc('id');
    }
}
