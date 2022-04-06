@extends('layouts.app')

@section('container')
<h1 class="mb-3 text-center">All Article</h1>

<div class="row justify-content-center mb-3">
    <div class="col-md-6">
        <form action="/" method="GET">
            <div class="input-group mb-3">
                <input type="search" class="form-control" placeholder="Cari artikel..." name="search">
                <button class="btn btn-success" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

@if ($articles->count())
<div class="card mb-3">
    @if($articles[0]->image)
    <img src="{{ asset('assets/' . $articles[0]->image) }}" alt="{{ $articles[0]->category->name }}" class="card-img-top" style="height: 400px;">
    @else
    <img src="https://source.unsplash.com/1200x400?{{ $articles[0]->category->name }}" class="card-img-top" alt="{{ $articles[0]->category->name }}">
    @endif

    <div class="card-body text-center">
        <h3 class="card-title">
            <a class="text-decoration-none text-dark" href="/{{ $articles[0]->id }}">
                {{ $articles[0]->title }}
            </a>
        </h3>
        <p>
            <small>
                By {{ $articles[0]->author->name }} in
                <a class="text-decoration-none" href="/categories/{{ $articles[0]->category->id }}">
                    {{ $articles[0]->category->name }}
                </a>
                {{ $articles[0]->created_at->diffForHumans() }}
            </small>
        </p>
        <p class="card-text">
            {{  Str::limit(strip_tags($articles[0]->content), $limit = 200, $end = '...')  }}
        </p>
        <a class="text-decoration-none btn btn-primary" href="/{{ $articles[0]->id }}">
            Read more
        </a>
    </div>
</div>

<div class="container">
    <div class="row">
        @foreach($articles->skip(1) as $article)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                    <a class="text-white text-decoration-none" href="/categories/{{ $article->category->id }}">
                        {{ $article->category->name }}
                    </a>
                </div>

                @if($article->image)
                <img src="{{ asset('assets/' . $article->image) }}" alt="{{ $article->category->name }}" class="card-img-top"  style="height: 260px;">
                @else
                <img src="https://source.unsplash.com/500x400?{{ $article->category->name }}" class="card-img-top" alt="{{ $article->category->name }}" style="height: 260px;">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p>
                        <small>
                            By {{ $article->author->name }}
                            {{ $article->created_at->diffForHumans() }}
                        </small>
                    </p>
                    <p class="card-text">
                        {{  Str::limit(strip_tags($article->content), $limit = 50, $end = '...')  }}
                    </p>
                    <a href="/{{ $article->id }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<p class="text-center fs-4">No post found.</p>
@endif

<div class="d-flex justify-content-center mb-4 mt-4">
    {{ $articles->links() }}
</div>
@endsection

