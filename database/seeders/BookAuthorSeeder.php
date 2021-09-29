<?php

namespace Database\Seeders;

use App\Models\BookAuthors;
use Illuminate\Database\Seeder;

class BookAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //BookAuthors::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 200; $i++) {
            BookAuthors::create([
                'book_id' => random_int(1,100),
                'author_id' => random_int(1,20)
            ]);
        }
    }
}
