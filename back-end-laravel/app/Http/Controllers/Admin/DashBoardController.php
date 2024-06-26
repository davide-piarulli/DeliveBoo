<?php

namespace App\Http\Controllers\Admin;

use App\Charts\OrdersAmountsChart;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\Facades\Charts;
use App\Charts\OrdersChart;




use Illuminate\Support\Facades\Auth;


class DashBoardController extends Controller
{
  public function index(OrdersChart $charts, OrdersAmountsChart $amounts)
  {
    $n_products = Product::where('restaurant_id', Auth::user()->id)->count();

    return view('admin.home', compact('n_products', 'charts', 'amounts'));
  }
}
