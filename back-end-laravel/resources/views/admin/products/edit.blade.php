@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="my-3">Modifica Prodotto</h1>

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
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input
                        name="name"
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        value="{{ old('name', $product->name) }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea
                        name="description"
                        class="form-control @error('description') is-invalid @enderror"
                        id="description"
                        rows="5">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo</label>
                    <input
                        name="price"
                        type="number"
                        step="0.01"
                        class="form-control @error('price') is-invalid @enderror"
                        id="price"
                        value="{{ old('price', $product->price) }}">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                  <label for="image" class="form-label">Immagine</label>
                  <input type="hidden" name="isUploaded" value="true" id="isUploaded">
                  <div class="d-flex">
                    <div id="uploaded-file" class="w-100 overflow-auto d-flex align-items-center rounded-2 px-2 {{old('image', $product?->image) ? 'd-block' : 'd-none'}}"><span>{{$product?->image_original_name}}</span></div>
                    <input name="image" type="file" class="form-control {{old('image', $product?->image) ? 'd-none' : 'd-inline-block'}} @error('image') is-invalid @enderror" id="image"
                      placeholder="Carica immagine" value="{{old('image', $product?->image)}}" onchange="addFile(); showImage(event)">
                  </div>
                  @error('image')
                  <div class="text-danger my-1" style="font-size: .8rem">{{$message}}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <img class="thumb mt-3" id="thumb" src="{{isset($product->image) ? asset('storage/' . $product->image) : asset('img/no-image.jpg')}}" alt="Product Image" style="width: 150px; height: auto;">
                  <button class="btn btn btn-outline-danger {{old('image', $product?->image) ? 'd-inline-block' : 'd-none'}}" id="file-remover" onclick="event.preventDefault(); resetFile()">Rimuovi file</button>
                </div>

                <div class="mb-4">
                    <button class="btn btn-primary" type="submit">Aggiorna Prodotto</button>
                    <button class="btn btn-warning" type="reset" onclick="resetImage()">Reset</button>
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
  thumb = document.getElementById('thumb');

  function resetFile(){
    isUploaded.value = false;
    image.value = '';
    uploadedFile.classList.add('d-none');
    fileRemover.classList.add('d-none');
    image.classList.remove('d-none');
    image.classList.add('d-inline-block');
    thumb.src = '{{ asset("img/no-image.jpg") }}';
  }

  function addFile(){
    isUploaded.value = true;
    fileRemover.classList.remove('d-none');
    fileRemover.classList.add('d-inline-block');
  }

  function showImage(event){
    if (event.target.files.length > 0) {
      thumb.src = URL.createObjectURL(event.target.files[0]);
    }
  }

</script>

@endsection
