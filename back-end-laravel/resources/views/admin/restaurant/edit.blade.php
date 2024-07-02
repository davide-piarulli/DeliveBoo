@extends('layouts.admin')
@section('content')
  <div class="container">
    <div class="d-flex align-items-center">
      <h1>Aggiungi logo</h1>
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
        <form id="restaurantForm" action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="logo" class="form-label">Immagine</label>
            <input type="hidden" name="isUploaded" value="true" id="isUploaded">
            <div class="d-flex">
              <div id="uploaded-file"
                class="w-100 overflow-auto d-flex align-items-center rounded-2 px-2 {{ old('logo', $restaurant->logo) ? 'd-block' : 'd-none' }}">
                <span>{{ $restaurant->logo_original_name }}</span>
              </div>
              <input name="logo" type="file"
                class="form-control {{ old('logo', $restaurant->logo) ? 'd-none' : 'd-inline-block' }} @error('logo') is-invalid @enderror"
                id="image" placeholder="Carica immagine" value="{{ old('logo', $restaurant->logo) }}"
                onchange="showImage(event); addFile()">
            </div>
            @error('logo')
              <div class="text-danger my-1" style="font-size: .8rem">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <img class="thumb mt-3" id="thumb"
              src="{{ isset($restaurant->logo) ? asset('storage/' . $restaurant->logo) : asset('img/no-image.jpg') }}"
              alt="restaurant logo" style="width: 150px; height: auto;">
            <button class="btn btn-outline-danger {{ old('logo', $restaurant->logo) ? 'd-inline-block' : 'd-none' }}"
              id="file-remover" onclick="event.preventDefault(); resetFile()">Rimuovi file</button>
          </div>
          <div class="mb-4">
            <button class="btn btn-primary" type="submit">Aggiungi Logo</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    isUploaded = document.getElementById('isUploaded');
    uploadedFile = document.getElementById('uploaded-file');
    fileRemover = document.getElementById('file-remover');
    image = document.getElementById('image');

    function showImage(event) {
      if (event.target.files.length > 0) {
        thumb.src = URL.createObjectURL(event.target.files[0]);
      }
    }

    function resetImage() {
      const thumb = document.getElementById('thumb');
      thumb.src = "{{ isset($restaurant->logo) ? asset('storage/' . $restaurant->logo) : asset('img/no-image.jpg') }}";
    }

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
  </script>
@endsection
