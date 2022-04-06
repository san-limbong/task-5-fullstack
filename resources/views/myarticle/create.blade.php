@extends('layouts.app')

@section('container')
<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Article</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form method="POST" action="/home/articles" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        @foreach($categories as $category)
                        <option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Post Image</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control  @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    @error('content')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="d-flex bd-highlight mb-3">
                    <div class="p-2 bd-highlight"><a href="/home" class="btn btn-primary">Back</a></div>
                    <div class="ms-auto p-2 bd-highlight"><button type="submit" class="btn btn-success">Create Article</button></div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection
