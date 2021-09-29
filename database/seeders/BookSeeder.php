<?php

namespace Database\Seeders;

use App\Models\Books;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Books::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 100; $i++) {
            Books::create([
                'category_id' => random_int(1,20),
                'title' => $faker->sentence,
                'avatar' => $faker->imageUrl,
                'rate' => 0,
                'publisher_id' => random_int(1,10),
                'price' =>random_int(10000, 500000),
                'number_stock' => 0,
                'number_sold' =>0
            ]);
        }
    }
}
