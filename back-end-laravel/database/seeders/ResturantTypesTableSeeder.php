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

    // Assegna un tipo a ciascun ristorante
    $restaurants = Restaurant::all();
    $types = Type::all();
    foreach ($restaurants as $restaurant) {
      $type_id = $types->random()->id;

      // Crea una chiave unica per la combinazione
      $combinationKey = $restaurant->id . '-' . $type_id;

      // Aggiungi la combinazione all'array delle combinazioni assegnate
      $assignedCombinations[] = $combinationKey;

      // Assegna il tipo al ristorante
      $restaurant->types()->attach($type_id);
    }

    // Conta quante assegnazioni sono già state fatte
    $assignedCount = count($assignedCombinations);

    // Continua ad assegnare tipi casuali fino a raggiungere 40 assegnazioni totali
    while ($assignedCount < 55) {
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

      // Incrementa il conteggio delle assegnazioni
      $assignedCount++;
    }
  }
}
