<?php

namespace Database\Seeders;

use App\Models\OrderVouchers;
use Illuminate\Database\Seeder;

class OrderVoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // OrderVouchers::truncate();
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 50; $i++) {
            OrderVouchers::create([
                'order_id' => random_int(1,100),
                'voucher_id' => random_int(1, 30)
            ]);
        }
    }
}
