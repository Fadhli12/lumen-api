<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class ClaimReward extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'device_id','offer_id','score','status','claim_date'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $dates = [
        'claim_date'
    ];

    public function offer(){
        return $this->belongsTo(Offer::class,'offer_id');
    }
}
