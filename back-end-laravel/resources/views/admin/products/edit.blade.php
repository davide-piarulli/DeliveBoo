@extends('layouts.admin')
@section('content')
  <div class="container">
    <div class="d-flex align-items-center">
      <h1>Modifica Prodotto</h1>
      <form class="ms-3" action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
        onsubmit="return confirm('Sei sicuro di voler eliminare {{ $product->name }}?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
          <i class="fa-solid fa-trash"></i>
        </button>
      </form>
    </div>
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
        <form id="productForm" action="{{ route('admin.products.update', $product->id) }}" method="POST"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- Nome Prodotto --}}
          <div class="mb-3">
            <label for="name" class="form-label">Nome<span class="fw-bold text-danger"> *</span></label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
              value="{{ old('name', $product->name) }}">
            <small id="nameError" class="text-danger"></small>
            @error('name')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          {{-- Descrizione Prodotto --}}
          <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
              rows="5">{{ old('description', $product->description) }}</textarea>
            @error('description')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          {{-- Prezzo Prodotto --}}
          <div class="mb-3">
            <label for="price" class="form-label">Prezzo<span class="fw-bold text-danger"> *</span></label>
            <input name="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
              id="price" value="{{ old('price', $product->price) }}">
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
            <input type="hidden" name="isUploaded" value="true" id="isUploaded">
            <div class="d-flex">
              <div id="uploaded-file"
                class="w-100 overflow-auto d-flex align-items-center rounded-2 px-2 {{ old('image', $product->image) ? 'd-block' : 'd-none' }}">
                <span>{{ $product->image_original_name }}</span>
              </div>
              <input name="image" type="file"
                class="form-control {{ old('image', $product->image) ? 'd-none' : 'd-inline-block' }} @error('image') is-invalid @enderror"
                id="image" placeholder="Carica immagine" value="{{ old('image', $product->image) }}"
                onchange="showImage(event); addFile()">
            </div>
            @error('image')
              <div class="text-danger my-1" style="font-size: .8rem">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <img class="thumb mt-3" id="thumb"
              src="{{ isset($product->image) ? asset('storage/' . $product->image) : asset('img/no-image.jpg') }}"
              alt="Product Image" style="width: 150px; height: auto;">
            <button class="btn btn-outline-danger {{ old('image', $product->image) ? 'd-inline-block' : 'd-none' }}"
              id="file-remover" onclick="event.preventDefault(); resetFile()">Rimuovi file</button>
          </div>
          <div class="mb-4">
            <button class="btn btn-primary" type="submit">Modifica Prodotto</button>
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
        nameField.classList.add('is-invalid');
        formIsValid = false;
      } else {
        nameError.textContent = '';
        nameField.classList.remove('is-invalid');
      }
      // Validazione del campo Prezzo
      const priceField = document.getElementById('price');
      const priceValue = priceField.value.trim();
      const priceError = document.getElementById('priceError');
      if (priceValue === '') {
        priceError.textContent = 'Inserisci il prezzo del prodotto.';
        priceField.classList.add('is-invalid');
        formIsValid = false;
      } else {
        priceError.textContent = '';
        priceField.classList.remove('is-invalid');
      }
      // Validazione del campo Tipi di Prodotto
      let productTypeChecked = false;
      const productTypes = document.querySelectorAll('input[name="product_type_id"]');
      const productTypeValidation = document.getElementById('productTypeValidation');
      productTypes.forEach(productType => {
        if (productType.checked) {
          productTypeChecked = true;
        }
      });
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

    function addFile() {
      isUploaded.value = true;
      fileRemover.classList.remove('d-none');
      fileRemover.classList.add('d-inline-block');
    }

    function resetFile() {
      isUploaded.value = false;
      image.value = '';
      uploadedFile.classList.add('d-none');
      fileRemover.classList.add('d-none');
      image.classList.remove('d-none');
      image.classList.add('d-inline-block');
      thumb.src = '{{ asset('img/no-image.jpg') }}';
    }

    function showImage(event) {
      if (event.target.files.length > 0) {
        thumb.src = URL.createObjectURL(event.target.files[0]);
      }
    }

    function resetImage() {
      const thumb = document.getElementById('thumb');
      thumb.src = "{{ isset($product->image) ? asset('storage/' . $product->image) : asset('img/no-image.jpg') }}";
    }
  </script>
@endsection
