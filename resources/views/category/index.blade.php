@extends('layouts.app')

@section('container')
    <h1 class="mb-5">Article Categories</h1>

    <div class="container">
        <div class="row justify-content-center">
            @if (session()->has('success'))
            <div class="alert alert-success col-md-12 text-center" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if (session()->has('info'))
            <div class="alert alert-info col-md-12 text-center" role="alert">
                {{ session('info') }}
            </div>
            @endif
            @if (session()->has('danger'))
            <div class="alert alert-danger col-md-12 text-center" role="alert">
                {{ session('danger') }}
            </div>
            @endif
        </div>
        @can('admin')
        <a href="/categories/create" class="btn btn-success mb-3">Create New Category</a>
        @endcan
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="px-3 py-2">
                            @can('admin')
                            <div class="d-flex bd-highlight">
                                <div class="p-2 bd-highlight"><a href="/categories/{{ $category->id }}/edit" class="btn btn-primary mb-3">Edit Category</a></div>
                                    <div class="ms-auto p-2 bd-highlight">
                                        <form action="/categories/{{ $category->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                        <button type="submit" class="btn btn-danger"onclick="return confirm('Categories with articles will be removed?! You are sure?')">Delete Category</button>
                                    </div>
                                </form>
                            </div>
                            @endcan

                            <a href="{{ route('categories.show',$category->id) }}">
                                <div class="card bg-dark text-white">
                                    <img src="https://source.unsplash.com/500x500?{{ $category->name }}" class="card-img" alt="{{ $category->name }}">
                                    <div class="card-img-overlay d-flex align-items-center p-0">
                                        <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0, 0.7)">{{ $category->name }}</h5>                                
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                
                </div>
            @endforeach
        </div>
    </div>
@endsection