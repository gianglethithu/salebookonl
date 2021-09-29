<?php

namespace Database\Seeders;

use App\Models\Customers;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Customers::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 30; $i++) {
            Customers::create([
                'name' => $faker->name,
                'address' =>$faker->address,
                'phone' => $faker->phoneNumber,
                'credit' => $faker->buildingNumber
            ]);
        }
    }
}
