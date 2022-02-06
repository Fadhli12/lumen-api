<?php

namespace App\Http\Controllers;

use App\Models\SpecialOfferCalendar;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    function isWeekend($date) {
        $weekDay = date('w', strtotime($date));
        return ($weekDay == 0 || $weekDay == 6);
    }

    function isSpecialDate($date){
        return SpecialOfferCalendar::where('date',$date)->where('active',true)->first() != null;
    }
}
