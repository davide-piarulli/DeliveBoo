<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


public function run(): void
{
$this->call([
  UsersTableSeeder::class,
  RestaurantsTableSeeder::class,
  TypesTableSeeder::class,
  ResturantTypesTableSeeder::class,
  ProductTypesTableSeeder::class,
  ProductsTableSeeder::class,
  OrdersTableSeeder::class,
  OrderProductsTableSeeder::class,


]);

  }
}
