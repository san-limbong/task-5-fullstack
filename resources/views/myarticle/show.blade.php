@extends('layouts.app')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-3">{{ $article->title }}</h1>
            <a href="/home" class="btn btn-success">
                <span data-feather="arrow-left"></span>
                Back to all my article
            </a>
            <a href="/home/articles/{{ $article->id }}/edit" class="btn btn-warning">
                <span data-feather="edit"></span>
                Edit
            </a>
            <form action="/home/articles/{{ $article->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                    <span data-feather="x-circle"></span>
                    Delete
                </button>
            </form>
            @if($article->image)
            <div style="max-height: 400px; max-width:1200px; overflow:hidden;">
                <img src="/assets/{{$article->image}}" alt="" class="img-fluid mt-3">
            </div>
            @else
            <div style="max-height: 400px; max-width:1200px; overflow:hidden;">
                <img src="https://source.unsplash.com/1200x400?{{ $article->category->name }}" alt="{{ $article->category->name }}" class="img-fluid mt-3">
            </div>
            @endif
            <article class="my-3 fs-5">
                {!! $article->content !!}
            
            </article>
        </div>
    </div>
</div>
@endsection
