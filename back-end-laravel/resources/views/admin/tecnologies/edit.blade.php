@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="my-3">Modifica Tecnologia</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('admin.tecnologies.update', $tecnology->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input
                        name="title"
                        type="text"
                        class="form-control @error('title') is-invalid @enderror"
                        id="title"
                        value="{{ old('title', $tecnology->title) }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="language" class="form-label">Linguaggio</label>
                    <input
                        name="language"
                        type="text"
                        class="form-control @error('language') is-invalid @enderror"
                        id="language"
                        value="{{ old('language', $tecnology->language) }}">
                    @error('language')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <button class="btn btn-danger" type="submit">Aggiorna la Tecnologia</button>
                    <button class="btn btn-warning" type="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
