<?php

namespace Database\Seeders;

use App\Models\Order;
use Carbon\Carbon;
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

    for ($i = 0; $i < 200; $i++) {

      $new_order = new Order();
      $new_order->name = $faker->firstName();
      $new_order->lastname = $faker->lastName();
      $new_order->email = $faker->email();
      $new_order->amount = floatval(rand(3, 20) . '.' . rand(10, 99));
      $new_order->address =  $faker->streetAddress();
      $new_order->city =  $faker->city();
      $new_order->state =  $faker->stateAbbr();
      $new_order->postal_code =  $faker->randomNumber(5, true);
      $new_order->phone =  3 . rand(2,4) . $faker->randomNumber(8, true);
      $new_order->notes =  $faker->text;

      $random_created_at = Carbon::now()->subMonths(rand(1, 6))->subDays(rand(0, 30));

      $new_order->created_at = $random_created_at;

      $new_order->save();
    }
  }
}
