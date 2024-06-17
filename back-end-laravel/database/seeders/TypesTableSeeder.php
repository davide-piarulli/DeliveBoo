<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helper;


class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = config('restaurantTypes');

        foreach($types as $type){

          $new_type = new Type();
          $new_type->name = $type;
          $new_type->slug = Helper::generateSlug($new_type->name, Type::class);
          $new_type->save();

        }


    }
}
