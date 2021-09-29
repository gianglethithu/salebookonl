<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Categories::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 20; $i++) {
            Categories::create([
                'name' => $faker->title,
                'level' => 1,
                'number_title' => 0,
                'number_sold' => 0,
                'parent_id' => random_int(1, 3)
            ]);
        }
    }
}
