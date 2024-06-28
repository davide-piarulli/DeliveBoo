<?php

namespace App\Charts;

use App\Models\Order;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        // Trova il primo e l'ultimo mese con ordini
        $firstOrder = Order::withoutGlobalScopes()
            ->whereHas('products', function ($query) {
                $query->where('restaurant_id', Auth::user()->id);
            })
            ->orderBy('created_at')
            ->first();

        $lastOrder = Order::withoutGlobalScopes()
            ->whereHas('products', function ($query) {
                $query->where('restaurant_id', Auth::user()->id);
            })
            ->orderBy('created_at', 'desc')
            ->first();

        // Se non ci sono ordini, usa l'anno corrente
        $startDate = $firstOrder ? Carbon::parse($firstOrder->created_at) : Carbon::now();
        $endDate = $lastOrder ? Carbon::parse($lastOrder->created_at) : Carbon::now();

        // Inizializza un array con tutti i mesi tra il primo e l'ultimo ordine
        $months = [];
        while ($startDate->lessThanOrEqualTo($endDate)) {
            $month = $startDate->format('Y-m');
            $months[$month] = 0;
            $startDate->addMonth();
        }

        // Popola l'array con i dati effettivi
        foreach ($orders as $order) {
            $month = $order->year . '-' . str_pad($order->month, 2, '0', STR_PAD_LEFT);
            $months[$month] = $order->count;
        }

        // Estrai etichette e valori
        $labels = array_keys($months);
        $data = array_values($months);

        // Imposta etichette e dataset per il grafico
        $this->labels($labels);
        $this->dataset('Ordini per mese', 'bar', $data)
            ->backgroundColor('rgba(54, 162, 235, 0.2)')
            ->color('rgba(54, 162, 235, 1)');
    }
}
