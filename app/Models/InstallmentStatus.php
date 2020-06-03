<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentStatus extends Model
{
    protected $table = 'installment_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active'
    ];

    /**
     * Get the user that owns the client.
     */
    public function order()
    {
        return $this->belongsTo('App\Models\OrderInstallment');
    }

}
