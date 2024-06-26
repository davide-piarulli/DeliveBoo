<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashBoardController extends Controller
{
  public function index()
  {
    $n_products = Product::where('restaurant_id', Auth::user()->id)->count();

    $chart_options = [
      'chart_title' => 'Utenti per mese',
      'report_type' => 'group_by_date',
      'model' => 'App\Models\Order',
      'group_by_field' => 'created_at',
      'group_by_period' => 'month',
      'chart_type' => 'bar',
      // 'aggregate_field' => 'amount', // Campo da aggregare (prezzo degli ordini)
      // 'aggregate_function' => 'avg', // Funzione di aggregazione (somma, media, etc.)
    ];
    $chart1 = new LaravelChart($chart_options);

    $chart_options2 = [
      'chart_title' => 'Prezzo medio per ogni ordine',
      'report_type' => 'group_by_date',
      'model' => 'App\Models\Order',
      'group_by_field' => 'created_at',
      'group_by_period' => 'month',
      'chart_type' => 'bar',
      'aggregate_field' => 'amount', // Campo da aggregare (prezzo degli ordini)
      'aggregate_function' => 'avg', // Funzione di aggregazione (somma, media, etc.)
    ];
    $chart2 = new LaravelChart($chart_options2);



    return view('admin.home', compact('n_products', 'chart1', 'chart2'));
  }
}
