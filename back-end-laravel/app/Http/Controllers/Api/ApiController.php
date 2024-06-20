<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Type;

class ApiController extends Controller
{
  public function index()
  {
      $restaurants = Restaurant::with('products.productType', 'types')->get();
      return response()->json($restaurants);
  }

  public function getRestaurantTypes()
  {
    $types = Type::all();
    return response()->json($types);
  }

}
