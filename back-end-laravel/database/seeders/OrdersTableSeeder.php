<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrdersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(Faker $faker): void
  {

    for ($i = 0; $i < 5; $i++) {

      $new_order = new Order();
      $new_order->name = $faker->firstName();
      $new_order->lastname = $faker->lastName();
      $new_order->amount = floatval(rand(3, 20) . '.' . rand(10, 99));
      $new_order->shipment_address =  $faker->address;
      $new_order->phone =  $faker->randomNumber(9, true);
      $new_order->notes =  $faker->text;
      $new_order->save();

    }
  }
}
