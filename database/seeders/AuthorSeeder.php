<?php

namespace Database\Seeders;

use App\Models\Authors;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Authors::truncate();

       $faker = \Faker\Factory::create();

       // And now, let's create a few articles in our database:
       for ($i = 0; $i < 20; $i++) {
           Authors::create([
               'name' => $faker->userName,
               'avatar' => $faker->imageUrl,
               'email' =>$faker->email
           ]);
       }
    }
}
