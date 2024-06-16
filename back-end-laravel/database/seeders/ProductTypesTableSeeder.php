<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
          $new->save();
        }

    }
}
