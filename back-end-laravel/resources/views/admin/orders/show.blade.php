@extends('layouts.admin')

@section('content')
  <div class="container">
    <h1 class="my-3">Ordine n: {{ $order->id }}</h1>
    <div class="customer-details">
      <h3>Anagrafica cliente</h3>
      <h5>Cliente: {{ $order->name }} {{ $order->lastname }}</h5>
      <h5>Email: {{ $order->email }}</h5>
      <h5>Telefono: {{ $order->phone }}</h5>
      <h5>Indirizzo di consegna: {{ $order->shipment_address }}</h5>
      <h5>Note: {{ $order->notes }}</h5>
    </div>

    {{-- tabella prodotti ordinati --}}
    <div class="order-products m-3">
      <h2>Dettaglio prodotti ordinati</h2>
      <table class="table table-striped table-bordered" id="products-table">
        <thead>
          <tr>
            <th scope="col" class="w-25">Immagine</th>
            <th scope="col">Quantità</th>
            <th scope="col" class="w-25">Nome prodotto</th>
            <th scope="col" class="w-25">Descrizione</th>
            <th scope="col">Prezzo</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
            <tr>
              <td><img class="img-fluid bg-dark w-25"
                  src="{{ isset($product->image) ? asset('storage/' . $product->image) : asset('img/no-image.jpg') }}"
                  alt="Product Image"></td>
              <td class="text-center">{{ $product->pivot->quantity }}</td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->description }}</td>
              <td>€ {{ number_format($product->pivot->quantity * $product->price, 2, ',', "") }}</td>
            </tr>
          @endforeach
          <tr>
            <td colspan="4">Spedizione</td>
            <td>€ 4,99</td>
          </tr>
          <tr>
            <td colspan="4">Totale</td>
            <td>€ {{ number_format($order->amount, 2, ',', "") }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@endsection
