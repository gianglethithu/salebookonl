<?php

namespace Database\Seeders;

use App\Models\Groups;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Groups::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 10; $i++) {
            Groups::create([
                'name' => $faker->name,
                'total_sales' => 0
            ]);
        }
    }
}
