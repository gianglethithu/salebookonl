<?php

namespace Database\Seeders;

use App\Models\OrderItems;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //OrderItems::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 300; $i++) {
            OrderItems::create([
                'order_id' => random_int(1,200),
                'book_id' => random_int(1,100),
                'quantity' => random_int(1,10),
                'price' => 0
            ]);
        }
    }
}
