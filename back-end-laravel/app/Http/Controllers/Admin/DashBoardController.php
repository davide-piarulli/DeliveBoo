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
    public function index(){
      $n_products = Product::where('restaurant_id', Auth::user()->id)->count();

      $chart_options = [
        'chart_title' => 'Utenti per nome',
        'report_type' => 'group_by_string',
        'model' => 'App\Models\User', // Modello associato alla tabella degli utenti
        'group_by_field' => 'name', // Campo per raggruppare i dati (nome degli utenti)
        'chart_type' => 'pie', // Tipo di grafico (torta nel tuo caso)
        'filter_field' => 'created_at', // Campo per il filtro
        'filter_period' => 'month', // Mostra solo gli utenti registrati questo mese
    ];


    $chart1 = new LaravelChart($chart_options);
      return view('admin.home', compact('n_products', 'chart1'));
    }
}

