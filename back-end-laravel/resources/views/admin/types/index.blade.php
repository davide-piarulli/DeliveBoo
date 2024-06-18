{{-- @extends('layouts.admin')

@section('content')

<div class="container">
  <h1 class="text-center m-4">TIPOLOGIE DI RISTORANTE</h1>

  <!-- Pulsante "Crea un nuovo tipo di prodotto" -->
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

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col" class="w-100">Nome Ristorante</th>
          <th scope="col">Azioni</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($types as $type)
        <tr>
          <td>
            <form action="{{ route('admin.types.update', $type->id) }}" method="POST" id="form-edit-{{ $type->id }}">
              @csrf
              @method('PUT')
              <input type="text" name="name" value="{{ $type->name }}" class="form-control bg-transparent border-0">
            </form>
          </td>
          <td class="d-flex">
            <button onclick="submitForm({{ $type->id }})" class="btn btn-warning ms-3 me-1">
              <i class="fa-solid fa-pencil"></i>
            </button>
            <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger me-3"
                onclick="return confirm('Sei sicuro di voler eliminare questa tipologia?')"><i
                  class="fa-solid fa-trash-can"></i></button>
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

  <script>
    function submitForm(id) {
    const form = document.getElementById(`form-edit-${id}`);
    form.submit();
  }
  </script>

  @endsection --}}
