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
      $assignedCombinations = [];

      for ($i = 0; $i < 15; $i++) {
          do {
              // Seleziona un ristorante e un tipo a caso
              $restaurant = Restaurant::inRandomOrder()->first();
              $type_id = Type::inRandomOrder()->first()->id;

              // Crea una chiave unica per la combinazione
              $combinationKey = $restaurant->id . '-' . $type_id;
          } while (in_array($combinationKey, $assignedCombinations));

          // Aggiungi la combinazione all'array delle combinazioni assegnate
          $assignedCombinations[] = $combinationKey;

          // Assegna il tipo al ristorante
          $restaurant->types()->attach($type_id);
      }
    }
}
