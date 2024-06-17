<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::all();

        if ($products->count() < $orders->count()) {
            $this->command->error('Non ci sono abbastanza prodotti per ogni ordine.');
            return;
        }

        $shuffledProducts = $products->shuffle();

        foreach ($orders as $index => $order) {
            $order->products()->attach($shuffledProducts[$index]->id);
        }
    }
}
