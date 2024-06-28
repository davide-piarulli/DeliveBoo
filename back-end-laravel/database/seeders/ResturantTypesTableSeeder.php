<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResturantTypesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    $config_restaurants = config('restaurants');

    $config_types = [];
    foreach($config_restaurants as $config_restaurant){
      $config_types[] = $config_restaurant['type_ids'];
    }

    $restaurants = Restaurant::all();

    foreach($restaurants as $index => $restaurant){

        $restaurant->types()->attach($config_types[$index]);

    }

  }
}
