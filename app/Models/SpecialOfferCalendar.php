<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class SpecialOfferCalendar extends Model
{
    protected $table = 'special_offer_calendar';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'description','active'
    ];

    protected $dates = [
        'date'
    ];
}
