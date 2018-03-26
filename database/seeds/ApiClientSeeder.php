<?php

use Illuminate\Database\Seeder;

class ApiClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('api_clients')->insert([
					'email' => 'admin@example.com',
					'token' => env('API_KEY', str_random(60))
				]);
    }
}
