@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="my-3 text-center">{{ $product->name }}</h1>
    <div class="text-center mb-3">
      <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning me-1">
          <i class="fa-solid fa-pencil"></i>
      </a>
      <form class="d-inline-block" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare {{ $product->name }}?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">
              <i class="fa-solid fa-trash"></i>
          </button>
      </form>
    </div>

    <div class="row flex-column">
        <div class="col d-flex justify-content-center">
            <img class="img-fluid bg-dark w-25" src="{{isset($product->image) ? asset('storage/' . $product->image) : asset('img/no-image.jpg')}}" alt="Product Image">
            <h5>{{$product->image_original_name}}</h5>
        </div>

        <div class="col m-4">
            <h3 class="fs-2">Categoria: {{ $product->productType->name }}</h3>
            <span class="fs-2">Descrizione</span>
            <p class="mt-3">{{ $product->description }}</p>
            <div class="col my-3">
                <h3>Prezzo</h3>
                <p class="pe-2">&euro; {{ $product->price }}</p>
            </div>

            <div class="my-5">
                <a href="{{ route('admin.products.index') }}" class="btn btn-danger"><i class="fa-solid fa-backward"></i></a>
            </div>
        </div>
    </div>

</div>

@endsection
