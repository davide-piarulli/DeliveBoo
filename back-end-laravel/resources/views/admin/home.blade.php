@extends('layouts.admin')

@section('content')
  {{-- <h2 class="text-center">Nell'archivio ci sono: {{ $n_products }} prodotti</h2> --}}
  <h1 class="text-center mb-3">Le statistiche del tuo ristorante</h1>

  <div class="container-fluid my-3">
    <div class="container mb-5">
      <h3>Ordini mensili</h3>
      <div style="width: 75%; margin: auto;">
        {!! $charts->container() !!}
      </div>
    </div>

    <div class="container">
      <h3>Fatturato mensile</h3>
      <div style="width: 75%; margin: auto;">
        {!! $amounts->container() !!}
      </div>
    </div>


    {{-- @php
          dd($charts->script());
      @endphp --}}

  </div>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
  {!! $charts->script() !!}
  {!! $amounts->script() !!}
@endsection
