<?php

namespace Database\Seeders;

use App\Models\Stores;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Stores::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 10; $i++) {
            Stores::create([
                'name' => $faker->name,
                'address' => $faker->address,
                'area' => $faker->streetAddress,
                'manager_id' => random_int(1,20)
            ]);
        }
    }
}
