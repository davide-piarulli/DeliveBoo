@extends('layouts.admin')

@section('content')
  <div class="container">
    <h1 class="text-center m-4">ORDINI RICEVUTI</h1>

    <!-- Barra di ricerca  -->
    <div class="row mb-3">
      <div class="col-md-12 d-flex justify-content-between align-items-center">
        <div class="d-flex">
          <input type="text" id="search-input" class="form-control" placeholder="Cerca ordine...">
          <button id="search-button" class="btn btn-primary ms-2">Cerca</button>
        </div>
      </div>
    </div>

    <table class="table table-striped table-bordered" id="products-table">
      <thead>
        <tr>

          <th scope="col">N. Ordine</th>
          <th scope="col">Data ordine</th>
          <th scope="col">Nome</th>
          <th scope="col">Cognome</th>
          <th scope="col">Totale ordine</th>
          <th scope="col">Azioni</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
          <tr>
            <td>#{{ $order->id }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->lastname }}</td>
            <td>{{ $order->amount }}</td>
            <td>
              <div class="d-flex">
                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-success btn-sm me-1">
                  <i class="fa-regular fa-eye"></i>
                </a>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{-- <div>{{ $products->links() }}</div> --}}

  </div>

  <script></script>
@endsection
