@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="my-3">Nuovo Progetto</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger p-3" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success p-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('admin.types.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Nome Progetto</label>
                    <input
                        name="title"
                        type="text"
                        class="form-control @error('title') is-invalid @enderror"
                        id="title"
                        value="{{ old('title') }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categories" class="form-label">Linguaggio Usato</label>
                    <input
                        name="categories"
                        type="text"
                        class="form-control @error('categories') is-invalid @enderror"
                        id="categories"
                        value="{{ old('categories') }}">
                    @error('categories')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <button class="btn btn-danger" type="submit">Crea Progetto</button>
                    <button class="btn btn-warning" type="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
