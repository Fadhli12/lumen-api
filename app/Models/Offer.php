<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Offer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reward_id', 'loyalty_id','special','active'
    ];

    protected $casts = [
        'special' => 'boolean',
        'active' => 'boolean'
    ];
}
