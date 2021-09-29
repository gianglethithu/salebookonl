<?php

namespace Database\Seeders;

use App\Models\Orders;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Orders::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 200; $i++) {
            Orders::create([
                'employee_id' => random_int(1,50),
                'customer_id' => random_int(1,30),
                'cost_amount' => 0,
                'total_discount' => 0,
                'deliver_cost' => random_int(10000, 50000),
                'pay_method' => 'credit'||'cast',
                'total_cost' => 0
            ]);
        }
    }
}
