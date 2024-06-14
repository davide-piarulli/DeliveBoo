@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="text-center m-4">Dettagli Tecnologia</h1>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Titolo:</strong> {{ $tecnology->title }}</p>
            <p><strong>Linguaggio:</strong> {{ $tecnology->language }}</p>
            <p><strong>File:</strong> {{ $tecnology->file }}</p>
        </div>
    </div>

    <a href="{{ route('admin.tecnologies.index') }}" class="btn btn-danger">Torna Indietro</a>
</div>

@endsection
