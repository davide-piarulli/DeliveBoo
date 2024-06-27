{{-- @extends('layouts.admin')

@section('content')
  <div class="container">
    <h1>Conferma Ordine - DeliveBoo</h1>

    <div class="order-details">
      <p>Gentile {{ $order->name }} {{ $order->lastname }},</p>
      <p>Gentile cliente,</p>
      <p>Grazie per il tuo ordine! Qui di seguito trovi i dettagli:</p>
      <p><strong>Numero ordine:</strong> {{ $order->id }}</p>
      <p><strong>Data ordine:</strong> {{ $order->created_at }}</p>
      <p><strong>Spedizione:</strong> € 4,99</p>
      <p><strong>Totale ordine:</strong> € {{ number_format($order->amount, 2, ',', '') }}</p>
    </div>

    <div class="product-list">
      <h3>Prodotti acquistati:</h3>
      @foreach ($products as $product)
        <div class="product-item">
          <p class="product-name">{{ $product->name }}</p>
          <p>Quantità: {{ $product->pivot->quantity }}</p>
          <p>Prezzo unitario: € {{ number_format($product->pivot->quantity * $product->price, 2, ',', '') }}</p>
        </div>
      @endforeach
    </div>

    <div class="email-footer">
      <p>Grazie per aver scelto il nostro servizio.</p>
      <p>Copyright &copy; {{ date('Y') }} DeliveBoo. Tutti i diritti riservati.</p>
    </div>
  </div>
@endsection --}}

@component('mail::message')
  {{-- # {{ $order['title'] }} --}}

  Ciao {{ $order['name'] }}! Il tuo ordine di € {{ $order['amount'] }} è stato ricevuto e verrà processato al più
  presto.


  {{-- @component('mail::button', ['url' => 'http://localhost:8080/#/'])
Visita il sito
@endcomponent --}}

  Grazie,<br>
  {{ config('app.name') }}
@endcomponent
