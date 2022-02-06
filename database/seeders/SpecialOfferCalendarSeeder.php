<?php

namespace Database\Seeders;

use App\Models\SpecialOfferCalendar;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class SpecialOfferCalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dates = [
            [
                'date' => new Carbon("2022-05-02"),
                'description' => 'Ied Fitri'
            ],
            [
                'date' => new Carbon("2022-05-03"),
                'description' => 'Ied Fitri'
            ],
        ];

        foreach ($dates AS $date){
            try {
                SpecialOfferCalendar::create($date);
            } catch (\Exception $exception){}
        }
    }
}
