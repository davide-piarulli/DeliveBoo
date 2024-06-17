@extends('layouts.admin')

@section('content')

<div class="container">
  <h1 class="my-3">Nuovo Prodotto</h1>

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
      <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nome</label>
          <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
            value="{{ old('name') }}">
          @error('name')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Descrizione</label>
          <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
            rows="5">{{ old('description') }}</textarea>
          @error('description')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Prezzo</label>
          <input name="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
            id="price" value="{{ old('price') }}">
          @error('price')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Tipi di Prodotto:</label>
          <div class="btn-group btn-group-sm" role="group">
            @foreach ($productTypes as $productType)
            <input name="product_type_id" id="product_type_{{ $productType->id }}" class="btn-check" autocomplete="off"
              type="radio" value="{{ $productType->id }}" @if (old('product_type_id')==$productType->id)
            checked
            @endif
            >
            <label class="btn btn-outline-primary" for="product_type_{{ $productType->id }}">{{ $productType->name
              }}</label>
            @endforeach
          </div>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Immagine</label>
          <input name="image" type="file" onchange="showImage(event)"
            class="form-control @error('image') is-invalid @enderror" id="image">
          <img class="thumb mt-3" id="thumb" src="{{asset('img/no-image.jpg')}}" alt="Default Image"
            style="width: 150px; height: auto;">
        </div>



        <div class="mb-4">
          <button class="btn btn-primary" type="submit">Nuovo Prodotto</button>
          <button class="btn btn-warning" type="reset" onclick="resetImage()">Reset</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function showImage(event){
        const thumb = document.getElementById('thumb');
        if (event.target.files.length > 0) {
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    }

    function resetImage() {
        const thumb = document.getElementById('thumb');
        thumb.src = "{{ asset('img/no-image.jpg') }}";
    }
</script>

@endsection
