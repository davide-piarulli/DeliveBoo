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
  public function run(): void
  {


    $products = config('products');

    foreach ($products as $product) {

      $new_product = new Product();
      $new_product->restaurant_id = $product['restaurant_id'];
      $new_product->product_type_id = $product['product_type_id'];
      $new_product->name = $product['name'];
      $new_product->slug = Helper::generateSlug($new_product->name, Product::class);
      $new_product->image = $product['image'];
      $new_product->description = $product['description'];
      $new_product->price = floatval(rand(3, 20) . '.' . rand(10, 99));
      $new_product->save();
    }
  }
}
