<?php

namespace App\Charts;

use App\Models\Order;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\Auth;

class OrdersChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
      parent::__construct();


      $this->displayLegend(true);

      $orders = Order::withoutGlobalScopes()
          ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
          ->whereHas('products', function ($query) {
            $query->where('restaurant_id', Auth::user()->id);
          })
          ->groupBy('year', 'month')
          ->orderBy('year')
          ->orderBy('month')
          ->get();


      $labels = $orders->map(function ($order) {
          return $order->year . '-' . str_pad($order->month, 2, '0', STR_PAD_LEFT);
      });

      $data = $orders->pluck('count');


      $this->labels($labels);
      $this->dataset('Ordini per mese', 'bar', $data)
          ->backgroundColor('rgba(54, 162, 235, 0.2)')
          ->color('rgba(54, 162, 235, 1)');
    }


}
