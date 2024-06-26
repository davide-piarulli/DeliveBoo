@extends('layouts.admin')

@section('content')
    <h2 class="text-center">Nell'archivio ci sono: {{ $n_products }} prodotti</h2>

    <div class="container d-flex">
        <div style="width: 75%; margin: auto;">
            {!! $charts->container() !!}
          </div>

          <div style="width: 75%; margin: auto;">
          </div>
          {!! $amounts->container() !!}

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
