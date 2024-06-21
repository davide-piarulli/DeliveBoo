<?php

namespace Database\Seeders;

use App\Functions\Helper;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class RestaurantsTableSeeder extends Seeder
{
  /**
   * Esegui il seeder del database.
   */
  public function run(Faker $faker): void
  {


    $restaurants = config('restaurants');


    foreach ($restaurants as $index => $restaurant) {
      $new_restaurant = new Restaurant();


      $new_restaurant->name = $restaurant['name'];
      $new_restaurant->user_id = $index + 1;
      $new_restaurant->slug = Helper::generateSlug($new_restaurant->name, Restaurant::class);
      
      $address_parts = explode(',', $restaurant['address']);
      $filtered_address = implode(',', array_slice($address_parts, 0, count($address_parts) - 2));
      $new_restaurant->address = $filtered_address;


      $new_restaurant->phone = $faker->numerify('34########');;


      $new_restaurant->logo = null;


      $new_restaurant->vat_number = $faker->numerify('###########');


      $new_restaurant->save();
    }
  }
}

