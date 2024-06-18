{{-- @extends('layouts.admin')

@section('content')
  <div class="container">
    <h1 class="text-center m-4">TIPI DI PRODOTTO</h1>

    <!-- Pulsante "Crea un nuovo tipo di prodotto" -->
    <div class="row mb-3">
      <form action="{{ route('admin.productsType.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nome Tipo di Prodotto</label>
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

    {{-- stampo box con errori relativi ai campi --}}
{{-- @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>
              {{ $error }}
            </li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger" role="alert">
        {{ session('error') }}
      </div>
    @endif

    @if (session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <table class="table table-striped table-bordered" id="products-table">
      <thead>
        <tr>
          <th scope="col" class="w-100">Nome</th>
          <th scope="col" class="text-center">Azioni</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($productsType as $productType)
          <tr>
            <td>
              <form action="{{ route('admin.productsType.update', $productType) }}" method="POST"
                id="form-edit-{{ $productType->id }}">
                @csrf
                @method('PUT')
                <input class="w-100 bg-transparent" type="text" value="{{ $productType->name }}" name="name">
              </form>
            </td>
            <td class="icons d-flex">

              <button onclick="submitForm({{ $productType->id }})" class="btn btn-warning ms-3 me-1">
                <i class="fa-solid fa-pencil"></i>
              </button>

              <form class="me-3" action="{{ route('admin.productsType.destroy', $productType) }}" method="post"
                onsubmit="return confirm('Sei sicuro di voler eliminare il tipo?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                  <i class="fa-solid fa-trash-can"></i>
                </button>
              </form>

            </td>
          </tr>
        @endforeach
      </tbody>
    </table>


  </div>
  <script>
    function submitForm(id) {
      const form = document.getElementById(`form-edit-${id}`);
      form.submit();
    }
  </script> --}}
{{-- @endsection --}}
