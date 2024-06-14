@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="my-3">Modifica Progetto</h1>

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
            <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input
                        name="title"
                        type="text"
                        class="form-control @error('title') is-invalid @enderror"
                        id="title"
                        value="{{ old('title', $project->title) }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea
                        name="description"
                        class="form-control @error('description') is-invalid @enderror"
                        id="description"
                        rows="5">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="language" class="form-label">Lingua</label>
                    <input
                        name="language"
                        type="text"
                        class="form-control @error('language') is-invalid @enderror"
                        id="language"
                        value="{{ old('language', $project->language) }}">
                    @error('language')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tecnologie:</label>
                    <div class="btn-group btn-group-sm" role="group">
                        @foreach ($tecnologies as $tecnology)
                            <input
                                name="tecnologies[]"
                                id="tag_{{ $tecnology->id }}"
                                class="btn-check"
                                autocomplete="off"
                                type="checkbox"
                                value="{{ $tecnology->id }}"
                                @if (in_array($tecnology->id, $project->tecnologies->pluck('id')->toArray()))
                                    checked
                                @endif
                            >
                            <label class="btn btn-outline-primary" for="tag_{{ $tecnology->id }}">{{ $tecnology->title }}</label>
                        @endforeach
                    </div>
                </div>



                <div class="mb-3">
                    <label for="image" class="form-label">Immagine</label>
                 <input
                   name="image"
                   type="file"
                   onchange="showImage(event)"
                   class="form-control @error('image') is-invalid @enderror"
                   id="image">

                   <img class="thumb mt-3" id="thumb" src="{{ asset('/image/no-image.jpg') }}" alt="Default Image" style="width: 150; height: auto;">
                </div>


                <div class="mb-4">
                    <button class="btn btn-danger" type="submit">Aggiorna il Progetto</button>
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
        thumb.src = "{{ asset('/image/no-image.jpg') }}";
    }
</script>


@endsection



