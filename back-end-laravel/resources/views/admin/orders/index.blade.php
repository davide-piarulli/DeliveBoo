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

    <table class="table table-striped table-bordered" id="orders-table">
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
            <td class="order-id">#{{ $order->id }}</td>
            <td class="order-date">{{ $order->created_at }}</td>
            <td class="order-name">{{ $order->name }}</td>
            <td class="order-lastname">{{ $order->lastname }}</td>
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

    <div>{{ $orders->links() }}</div>

  </div>

  <script>
    document.getElementById('search-input').addEventListener('keyup', filterOrders);
    document.getElementById('search-button').addEventListener('click', filterOrders);

    function filterOrders() {
      const searchValue = document.getElementById('search-input').value.toLowerCase();
      const ordersTable = document.getElementById('orders-table');
      const rows = ordersTable.getElementsByTagName('tr');

      for (let i = 1; i < rows.length; i++) {
        const name = rows[i].getElementsByClassName('order-name')[0].innerText.toLowerCase();
        const lastname = rows[i].getElementsByClassName('order-lastname')[0].innerText.toLowerCase();
        const id = rows[i].getElementsByClassName('order-id')[0].innerText.toLowerCase();

        if (name.includes(searchValue) || lastname.includes(searchValue) || id.includes(searchValue)) {
          rows[i].style.display = '';
        } else {
          rows[i].style.display = 'none';
        }
      }
    }
  </script>
@endsection
