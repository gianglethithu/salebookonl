<?php

namespace Database\Seeders;

use App\Models\Employees;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Employees::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 50; $i++) {
            Employees::create([
                'full_name' => $faker->domainName,
                'email' => $faker->email,
                'password' => $faker->password,
                'group_id' => random_int(1,10),
                'sale' => 0
            ]);
        }
    }
}
