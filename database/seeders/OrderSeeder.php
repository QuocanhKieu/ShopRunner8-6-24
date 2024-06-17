<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderDetail;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Define the date range
        $startDate = '2024-06-01';
        $endDate = '2024-06-16';

        // Convert dates to timestamps
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);

        // Loop through each day in the date range
        for ($currentTimestamp = $startTimestamp; $currentTimestamp <= $endTimestamp; $currentTimestamp = strtotime('+1 day', $currentTimestamp)) {
            $numOrders = rand(1, 10); // Generate a random number of orders for each day

            for ($i = 0; $i < $numOrders; $i++) {
                $createdAt = date('Y-m-d H:i:s', $currentTimestamp);
                $order = Order::create([
                    'user_id' => $faker->numberBetween(1, 5),
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'company_name' => $faker->company,
                    'country' => $faker->country,
                    'street_address' => $faker->streetAddress,
                    'postcode_zip' => $faker->postcode,
                    'town_city' => $faker->city,
                    'email' => $faker->email,
                    'phone' => $faker->phoneNumber,
                    'payment_type' => $faker->randomElement(['COD']),
                    'shipping_method' => $faker->randomElement(['express']),
                    'status' => $faker->numberBetween(0, 1),
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                    'note' => $faker->sentence,
                    'payment_status' => 1
                ]);

                $numOrderDetails = rand(1, 5); // Generate random number of order details for each order

                for ($j = 0; $j < $numOrderDetails; $j++) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $faker->numberBetween(1, 30),
                        'qty' => $faker->numberBetween(1, 10),
                        'amount' => $faker->numberBetween(20, 100),
                        'total' => DB::raw('qty * amount'),
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt,
                        'size' => $faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
                        'color' => 2,
                        'coupon' => $faker->word,
                    ]);
                }
            }
        }
    }
}
