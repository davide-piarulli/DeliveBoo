@extends('layouts.admin')

@section('content')

<h2 class="p-3">Tipologia Ristorante</h2>

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


<div>

    <div class="row mb-3">
        <form action="{{ route('admin.types.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Tipologia Ristorante</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
              value="{{ old('name') }}">
            @error('name')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="mb-4">
            <button class="btn btn-primary" type="submit">Crea Tipo</button>
            <button class="btn btn-warning" type="reset">Reset</button>
          </div>
        </form>
    </div>

    <table class="table table-striped table-bordered w-75 m-3">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nome Ristorante</th>
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
                        <input type="text" name="name" value="{{ $type->name }}" class="form-control">
                </td>
                <td class="d-flex">
                    <button type="submit" class="btn btn-warning btn-sm ms-2 me-2"><i class="fa-solid fa-pencil"></i></button>
                    </form>
                    <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questa tipologia?')"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row justify-content-center">
        <div class="col-md-6">
            {{ $types->links() }}
        </div>
    </div>

</div>

@endsection
