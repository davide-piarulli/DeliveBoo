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
                    <input
                       id="thumb-value"
                       name="image"
                       type="file"
                       value="{{ old('image', $product->image) }}"
                       onchange="showImage(event)"
                       class="form-control @error('image') is-invalid @enderror"
                       id="image">
                    <img class="thumb mt-3" id="thumb" src="{{isset($product->image) ? asset('storage/' . $product->image) : asset('img/no-image.jpg')}}" alt="Product Image" style="width: 150px; height: auto;">
                </div>

                <div class="mb-4">
                    <button class="btn btn-danger" type="submit">Aggiorna Prodotto</button>
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
        const thumbValue = document.getElementById('thumb-value');
        thumb.src = "{{asset('img/no-image.jpg')}}";
        thumbValue.value = null;
        console.log(thumbValue);
    }
</script>

@endsection
