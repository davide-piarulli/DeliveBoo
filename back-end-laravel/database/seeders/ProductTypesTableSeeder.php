<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helper;

class ProductTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_types = config('productTypes');

        foreach($product_types as $product_type){
          $new = new ProductType();
          $new->name = $product_type;
          $new->slug = Helper::generateSlug($new->name, ProductType::class);
          $new->save();
        }

    }
}
