@extends('layouts.app')

@section('container')
<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Category</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form method="POST" action="/categories/{{ $category->id }}" class="mb-5">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">User ID - Nama Pengguna</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" disabled value="{{ auth()->user()->id }} - {{ auth()->user()->name }}">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Judul kategori Lama</label>
                    <input type="text" class="form-control" id="name" name="name" disabled value="{{$category->name}}">

                    <label for="name" class="form-label">Judul kategori Baru</label>
                    <input type="text" placeholder="Masukkan nama kategori" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-flex bd-highlight mb-3">
                    <div class="p-2 bd-highlight"><a href="/categories" class="btn btn-primary">Back</a></div>
                    <div class="ms-auto p-2 bd-highlight"><button type="submit" class="btn btn-warning">Save Change</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
