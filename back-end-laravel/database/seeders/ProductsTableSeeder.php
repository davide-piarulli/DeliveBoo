<?php

namespace Database\Seeders;

use App\Functions\Helper;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(Faker $faker): void
  {

    $faker = \Faker\Factory::create();
    $faker->addProvider(new \FakerRestaurant\Provider\it_IT\Restaurant($faker));

    $restaurants = Restaurant::all();
    $product_types = ProductType::count();

    foreach ($restaurants as $index => $restaurant){

      for ($i = 0; $i < 20; $i++) {

        $new_product = new Product();
        $new_product->restaurant_id = $index + 1;
        $new_product->product_type_id = rand(1, $product_types);
        $new_product->name = $faker->foodName();
        $new_product->slug = Helper::generateSlug($new_product->name, Product::class);
        $new_product->image = null;
        $new_product->description = $faker->sentence(5);
        $new_product->price = floatval(rand(3, 20) . '.' . rand(10, 99));
        $new_product->save();

      }

    }

  }
}
