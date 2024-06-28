<?php

namespace App\Charts;

use App\Models\Order;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
            ->whereHas('products', function ($query) {
                $query->where('restaurant_id', Auth::user()->id);
            })
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Determina l'intervallo di date
        $firstOrder = $orders->first();
        $lastOrder = $orders->last();

        $startDate = $firstOrder ? Carbon::create($firstOrder->year, $firstOrder->month, 1) : Carbon::now();
        $endDate = $lastOrder ? Carbon::create($lastOrder->year, $lastOrder->month, 1) : Carbon::now();

        // Inizializza l'array dei mesi
        $months = [];
        while ($startDate->lessThanOrEqualTo($endDate)) {
            $month = $startDate->format('Y-m');
            $months[$month] = ['count' => 0, 'total_amount' => 0];
            $startDate->addMonth();
        }

        // Popola l'array con i dati effettivi
        foreach ($orders as $order) {
            $month = $order->year . '-' . str_pad($order->month, 2, '0', STR_PAD_LEFT);
            $months[$month] = ['count' => $order->count, 'total_amount' => $order->total_amount];
        }

        // Estrai etichette e valori
        $labels = array_keys($months);
        $counts = array_column($months, 'count');
        $totalAmounts = array_column($months, 'total_amount');

        // Configura i dati del grafico
        $this->labels($labels);


        // Aggiungi un secondo dataset per l'importo totale
        $this->dataset('€ Importo totale', 'line', $totalAmounts)
            ->backgroundColor('rgba(255, 99, 132, 0.2)')
            ->color('rgba(255, 99, 132, 1)'); // Configura il colore per la linea
    }
}
