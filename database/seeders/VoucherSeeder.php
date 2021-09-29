<?php

namespace Database\Seeders;

use App\Models\Vouchers;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vouchers::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 30; $i++) {
            Vouchers::create([
                'name' => $faker->name.' voucher',
                'discount' => random_int(1000,30000),
                'time_start' => $faker->dateTimeThisMonth('now'),
                'time_end' =>$faker->dateTimeThisMonth
            ]);
        }
    }
}
