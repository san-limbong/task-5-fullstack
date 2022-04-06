@extends('layouts.app')

@section('container')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h1 class="mb-3">{{$article->title}}</h1>
            <p>
                By {{ $article->author->name }} in
                <a class="text-decoration-none" href="/categories/{{ $article->category->id }}">{{ $article->category->name }}
                </a>
            </p>

            @if($article->image)
            <img src="{{ asset('assets/' . $article->image) }}" alt="{{ $article->category->name }}" class="img-fluid">
            @else
            <img src="https://source.unsplash.com/1200x400?{{ $article->category->name }}" alt="{{ $article->category->name }}" class="img-fluid">
            @endif

            <article class="my-3 fs-5">
                {!! $article->content !!}
            </article>

            <a href="/" class="d-block mt-3">Back to All Article</a>
        </div>
    </div>
</div>


@endsection