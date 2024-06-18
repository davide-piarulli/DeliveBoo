<?php

namespace Database\Seeders;

use App\Functions\Helper;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;




class RestaurantsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $restaurants = config('restaurants');


    foreach ($restaurants as $index=>$restaurant) {

      $new_restaurant = new Restaurant();

      // $new_restaurant->user_id = User::inRandomOrder()->first()->id;

      $new_restaurant->name = $restaurant['name'];
      $new_restaurant->user_id = $index + 1;
      $new_restaurant->slug = Helper::generateSlug($new_restaurant->name, Restaurant::class);
      $new_restaurant->address = $restaurant['address'];
      $new_restaurant->phone = floatval(rand(3, 20) . '.' . rand(10, 99));;
      $new_restaurant->logo = $restaurant['logo'];
      $new_restaurant->vat_number = $restaurant['vat_number'];

      $new_restaurant->save();

    }
  }
}
