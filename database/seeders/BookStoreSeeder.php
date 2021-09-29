<?php

namespace Database\Seeders;

use App\Models\Books;
use App\Models\BookStores;
use Illuminate\Database\Seeder;

class BookStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //BookStores::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 200; $i++) {
            BookStores::create([
                'store_id' => random_int(1,10),
                'book_id' => random_int(1,100),
                'number_in_stock' => random_int(1,30)
            ]);
        }
    }
}
