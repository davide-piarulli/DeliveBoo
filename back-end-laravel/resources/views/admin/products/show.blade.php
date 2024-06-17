@extends('layouts.admin')

@section('content')

<h1 class="my-3 text-center ">{{ $product->name }}</h1>

<div class="row flex-column ">
    <div class="col d-flex justify-content-center">
        <img class="img-fluid bg-dark" src="{{ asset('storage/' . $product->image)}}" alt="">
    </div>

    <div class="col m-4">
        <span class="fs-2 ">Descrizione</span>
        <p class="mt-3">{{ $product->description }}</p>
        <div class="col my-3">
            <h3>Prezzo</h3>
            <p class="pe-2">{{ $product->price }} €</p>
        </div>

        <div class="my-5">
            <a href="{{ route('admin.products.index') }}" class="btn btn-danger"><i class="fa-solid fa-backward"></i></a>
        </div>
    </div>
</div>

@endsection
