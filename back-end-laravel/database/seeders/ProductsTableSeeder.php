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
        $new_product->image = 'https://picsum.photos/id/' . rand(100, 800) . '/200/300';
        $new_product->description = $faker->sentence(5);
        $new_product->price = floatval(rand(3, 20) . ',' . rand(10, 99));
        $new_product->save();

      }

    }

    // $products = config('restaurantProducts');

    // foreach ($products['restaurant'] as $key => $product) {
    //   $restaurantId = $key;
    //   $restaurant = Restaurant::find($restaurantId);


    //   if ($restaurant) {
    //     $types = $restaurant->types;
    //     foreach ($types as $type) {
    //       // Verifica se il tipo di ristorante è contenuto nei tipi di prodotti

    //       foreach ($products['restaurant'] as $index => $product_) {

    //         if ($type->name == $product_['type']) {
    //           $new_product = new Product();

    //           $new_product->name = $product_['name'];
    //           $new_product->slug = Helper::generateSlug($new_product->name, Product::class);
    //           $new_product->image = $product_['image'];
    //           $new_product->description = $product_['description'];
    //           $new_product->price = $product_['price'];
    //           $new_product->visible = $product_['visible'];
    //           $new_product->restaurant_id =  $restaurantId;

    //           $new_product->save();

    //           //  dd( $new_product);


    //         } else {
    //           dump('errore');
    //         }
    //       }
    //     }
    //   }
    // }
  }
}

// da eliminare se non funziona la parte giu

// <?php

// namespace Database\Seeders;

// use App\Functions\Helper;
// use App\Models\Product;
// use App\Models\Restaurant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
// use Faker\Generator as Faker;


// class ProductsTableSeeder extends Seeder
// {
//   /**
//    * Run the database seeds.
//    */
//   public function run(): void
//   {


//     $product_counter = 0;
//     // ho i miei prodotti
//     $products = config('restaurantProducts');


//     while ($product_counter < 5) {

//       foreach ($products as $key => $product) {
//         $restaurantId = $key;
//         $restaurant = Restaurant::find($restaurantId);

//         if ($restaurant) {
//           $types = $restaurant->types;



//           foreach ($types as $type) {
//             // type->name (sono i types del prodotto esempio uno)

//             if ($type == $product->type) {
//               $new_product = new Product();

//               $new_product->name = $product->name;
//               $new_product->slug = Helper::generateSlug( $new_product->name, Product::class);
//               $new_product->image = $product->image;
//               $new_product->description = $product->description;
//               $new_product->price = $product->price;
//               $new_product->visible = $product->visible;

//               dd($new_product);

//             }
//           }
//           $product_counter = 5;
//         }
//       }
//     }
//   }
// }
