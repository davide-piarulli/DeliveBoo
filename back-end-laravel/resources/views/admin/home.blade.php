@extends('layouts.admin')

@section('content')
    <h2 class="text-center">Nell'archivio ci sono: {{ $n_products }} prodotti</h2>

    <h1>{{ $chart1->options['chart_title'] }}</h1>
    <div class="container">
      <div class="w-50">
         {!! $chart1->renderHtml() !!}
      </div>

    </div>


@endsection

@section('scripts')
    {!! $chart1->renderJs() !!}
@endsection

