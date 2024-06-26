<?php

namespace App\Charts;

use App\Models\Order;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\Auth;


class OrdersAmountsChart extends Chart
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

        // Ottieni i dati per il grafico
        $orders = Order::withoutGlobalScopes()
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count, SUM(amount) as total_amount')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Prepara i dati per il grafico
        $labels = $orders->map(function ($order) {
            return $order->year . '-' . str_pad($order->month, 2, '0', STR_PAD_LEFT);
        });


        $totalAmounts = $orders->pluck('total_amount');

        // Configura i dati del grafico
        $this->labels($labels);


        // Aggiungi un secondo dataset per l'importo totale (opzionale)
        $this->dataset('Importo totale', 'line', $totalAmounts)
            ->backgroundColor('rgba(255, 99, 132, 0.2)')
            ->color('rgba(255, 99, 132, 1)'); // Configura il colore per la linea

  }
}
