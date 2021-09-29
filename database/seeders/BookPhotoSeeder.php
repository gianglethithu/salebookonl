<?php

namespace Database\Seeders;

use App\Models\BookPhotos;
use Illuminate\Database\Seeder;

class BookPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //BookPhotos::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 400; $i++) {
            BookPhotos::create([
                'book_id' => random_int(1,100),
                'photo' => $faker->imageUrl,
            ]);
        }
    }
}
