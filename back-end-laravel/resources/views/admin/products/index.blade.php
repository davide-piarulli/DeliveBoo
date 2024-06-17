@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="text-center m-4">I MIEI PRODOTTI</h1>

    <!-- Barra di ricerca e pulsante "Crea un nuovo prodotto" -->
    <div class="row mb-3">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <input type="text" id="search-input" class="form-control" placeholder="Cerca prodotto...">
                <button id="search-button" class="btn btn-danger ms-2">Cerca</button>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-danger">Crea un nuovo prodotto</a>
        </div>
    </div>

    <table class="table table-striped table-bordered" id="products-table">
        <thead>
            <tr>
                <th scope="col">NOME</th>
                <th scope="col">CATEGORIA</th>
                <th scope="col">DESCRIZIONE</th>
                <th scope="col">PREZZO</th>
                <th scope="col">IMMAGINE</th>
                <th scope="col">AZIONI</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="product-name">{{ $product->name }}</td>
                    <td class="product-category">
                        @if ($product->productType)
                            <span class="badge text-bg-danger">{{ $product->productType->title }}</span>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td class="product-description">{{ $product->description }}</td>
                    <td class="product-price">{{ $product->price }}</td>
                    <td>
                        <img class="thumb mt-3" src="{{ asset('storage/' . $product->image) }}" onerror="this.src='{{ asset('image/no-image.jpg') }}'" alt="Product Image" style="width: 150px; height: auto;">
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-danger btn-sm me-1">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-danger btn-sm me-1">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare {{ $product->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<script>
    document.getElementById('search-input').addEventListener('keyup', filterProducts);
    document.getElementById('search-button').addEventListener('click', filterProducts);

    function filterProducts() {
        const searchValue = document.getElementById('search-input').value.toLowerCase();
        const productsTable = document.getElementById('products-table');
        const rows = productsTable.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) { // Start at 1 to skip the table header
            const name = rows[i].getElementsByClassName('product-name')[0].innerText.toLowerCase();
            const category = rows[i].getElementsByClassName('product-category')[0].innerText.toLowerCase();
            const description = rows[i].getElementsByClassName('product-description')[0].innerText.toLowerCase();
            const price = rows[i].getElementsByClassName('product-price')[0].innerText.toLowerCase();

            if (name.includes(searchValue) || category.includes(searchValue) || description.includes(searchValue) || price.includes(searchValue)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
</script>

@endsection
