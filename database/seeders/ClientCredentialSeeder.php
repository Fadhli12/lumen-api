<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientCredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client_credentials = [
            "id" => 1,
            "user_id" => 1,
            "name" => "titans",
            "secret" => "pQJZaul6nipUiRQ9g7OzZeQAxmcVQ71w76gwBDj6",
            "redirect" => "",
            "personal_access_client" => 0,
            "password_client" => 0,
            "revoked" => 0,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];
        try {
            DB::table("oauth_clients")->insert($client_credentials);
        }catch (\Exception $exception){}
    }
}
