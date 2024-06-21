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
        <form id="productForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          {{-- Nome Prodotto --}}
          <div class="mb-3">
            <label for="name" class="form-label">Nome<span class="fw-bold text-danger"> *</span></label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
              value="{{ old('name') }}">
            <small id="nameError" class="text-danger"></small>
            @error('name')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          {{-- Descrizione Prodotto --}}
          <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
              rows="5">{{ old('description') }}</textarea>
            @error('description')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          {{-- Prezzo Prodotto --}}
          <div class="mb-3">
            <label for="price" class="form-label">Prezzo<span class="fw-bold text-danger"> *</span></label>
            <input name="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
              id="price" value="{{ old('price') }}">
            <small id="priceError" class="text-danger"></small>
            @error('price')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          {{-- Tipo di Prodotto --}}
          <div class="mb-3">
            <label class="form-label">Tipi di Prodotto:<span class="fw-bold text-danger"> *</span></label>
            <div class="container-fluid">
              <div class="row row-cols-2 row-cols-lg-4">
                @foreach ($productTypes as $productType)
                  <div class="col mb-3">
                    <div class="btn-group btn-group-sm w-100" role="group">
                      <input name="product_type_id" id="product_type_{{ $productType->id }}" class="btn-check"
                        autocomplete="off" type="radio" value="{{ $productType->id }}"
                        @if (old('product_type_id') == $productType->id) checked @endif>
                      <label class="btn w-100"
                        for="product_type_{{ $productType->id }}">{{ $productType->name }}</label>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            <small id="productTypeValidation" class="text-danger"></small>
            @error('product_type_id')
              <br>
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          {{-- Immagine del Prodotto --}}
          <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input name="image" type="file" onchange="showImage(event)"
              class="form-control @error('image') is-invalid @enderror" id="image">
            <img class="thumb mt-3" id="thumb" src="{{ asset('img/no-image.jpg') }}" alt="Default Image"
              style="width: 150px; height: auto;">
            @error('image')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          {{-- Bottoni Form --}}
          <div class="mb-4">
            <button class="btn btn-primary" type="submit">Aggiungi</button>
            <button class="btn btn-warning" type="reset" onclick="resetImage()">Reset</button>
          </div>
          <p class="fw-bold text-danger">* Campi Obbligatori</p>
        </form>
      </div>
    </div>
  </div>
  <script>
    document.getElementById('productForm').addEventListener('submit', function(event) {
      let formIsValid = true;
      // Validazione del campo Nome
      const nameField = document.getElementById('name');
      const nameValue = nameField.value.trim();
      const nameError = document.getElementById('nameError');
      if (nameValue === '') {
        nameError.textContent = 'Inserisci il nome del prodotto.';
        formIsValid = false;
      } else {
        nameError.textContent = '';
      }
      // Validazione del campo Prezzo
      const priceField = document.getElementById('price');
      const priceValue = priceField.value.trim();
      const priceError = document.getElementById('priceError');
      if (priceValue === '') {
        priceError.textContent = 'Inserisci il prezzo del prodotto.';
        formIsValid = false;
      } else {
        priceError.textContent = '';
      }
      // Validazione del campo Tipi di Prodotto
      let productTypeChecked = false;
      const productTypes = document.querySelectorAll('input[name="product_type_id"]');
      const productTypeValidation = document.getElementById('productTypeValidation');
      for (const productType of productTypes) {
        if (productType.checked) {
          productTypeChecked = true;
          break;
        }
      }
      if (!productTypeChecked) {
        productTypeValidation.textContent = 'Seleziona un tipo di prodotto.';
        formIsValid = false;
      } else {
        productTypeValidation.textContent = '';
      }
      if (!formIsValid) {
        event.preventDefault(); // Impedisce l'invio del form
      }
    });

    function showImage(event) {
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
