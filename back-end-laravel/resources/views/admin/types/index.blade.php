@extends('layouts.admin')

@section('content')

<h2 class="p-3">Tipologia Progetto</h2>

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

<div class=" my-4 p-3">
    <a href="{{ route('admin.types.create') }}" class="btn btn-danger">Crea nuova tipologia</a>
</div>

<div>
    <table class="table table-striped table-bordered w-75 m-3">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nome Progetto</th>
                <th scope="col">Linguaggio Usato</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
            <tr>
                <td>
                    <form action="{{ route('admin.types.update', $type->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" value="{{ $type->title }}" class="form-control">
                </td>
                <td>
                    <input type="text" name="categories" value="{{ $type->categories }}" class="form-control">
                </td>
                <td class="d-flex">
                    <button type="submit" class="btn btn-warning btn-sm ms-2 me-2"><i class="fa-solid fa-pencil"></i></button>
                    </form>
                    <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questa tecnologia?')"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row justify-content-center">
        <div class="col-md-6">
            {{ $types->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection
