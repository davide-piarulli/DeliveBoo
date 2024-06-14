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
        for ($i=0; $i < 15; $i++) {
          $restaurant = Restaurant::inRandomOrder()->first();

          $type_id = Type::inRandomOrder()->first()->id;
          $restaurant->types()->attach($type_id);
        }
    }
}
