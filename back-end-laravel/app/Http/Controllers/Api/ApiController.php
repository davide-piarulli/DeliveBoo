<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Type;

class ApiController extends Controller
{
  public function index()
  {
    $restaurants = Restaurant::with([
      'products.productType',
      'types' => function ($query) {
        $query->orderBy('name', 'asc');
      }
    ])->orderBy('name', 'asc')->get();


    return response()->json($restaurants);
  }

  public function getRestaurantTypes()
  {
    $types = Type::orderBy('name', 'asc')->get();
    return response()->json($types);
  }

  public function getRestaurantsByTypes(Request $request)
  {

    // presi tutti i filtri li cicliamo per pushare soltanto gli id, utili per la query
    foreach ($request->filters as $filter) {
      $typesIds[] = $filter['id'];
    };

    // if (!$request->searched) {
    //   $request->searched = '';
    // }

    // Prendiamo tutti i tipi di ogni ristorante
    // where('name', 'like','%' . $request->searched . '%')->
    $restaurants = Restaurant::where('name', 'like', '%' . $request->searched . '%')->whereHas('types', function ($query) use ($typesIds) {
      // Filtra tutti i tipi di ristorante in base all'id
      $query->whereIn('types.id', $typesIds);
      // Assicura che il numero di tipi corrispondenti sia esattamente uguale al numero di tipi selezionati
    }, '=', count($typesIds))->withCount(['types' => function ($query) use ($typesIds) {
      // Conta i tipi corrispondenti per ogni ristorante
      $query->whereIn('types.id', $typesIds);
      // Filtra per includere solo i ristoranti che hanno esattamente il numero di tipi selezionati
    }])->having('types_count', '=', count($typesIds))->with('products.productType', 'types')->orderBy('name', 'asc')->get();

    return response()->json($restaurants);
  }

  public function getReustarantDetail($slug)
  {
    $restaurant = Restaurant::where('slug', $slug)->with('products.productType', 'types')->first();

    return response()->json($restaurant);
  }
}
