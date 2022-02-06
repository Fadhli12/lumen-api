<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 10; $i++) {
            try {
                Offer::create([
                    'reward_id' => random_int(100000, 999999),
                    'loyalty_id' => random_int(100000, 999999),
                    'special' => random_int(0, 1),
                ]);
            } catch (\Exception $exception){}
        }
    }
}
