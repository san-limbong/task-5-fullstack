@extends('layouts.app')

@section('container')
<div class="justify-content-center pb-2 mb-3 border-bottom">
    <h1 class="h2">My Article</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        @if (session()->has('success'))
        <div class="alert alert-success col-md-8 " role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if (session()->has('info'))
        <div class="alert alert-info col-md-8 " role="alert">
            {{ session('info') }}
        </div>
        @endif
        @if (session()->has('warning'))
        <div class="alert alert-warning col-md-8 " role="alert">
            {{ session('warning') }}
        </div>
        @endif
        <div class="col-md-8">
            <a href="/home/articles/create" class="btn btn-success mb-3">Create new article</a>
            <div class="card">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->category->name }}</td>
                        <td> 
                            <div class="btn-group" role="group">
                                <a href="/home/articles/{{ $article->id }}" class="btn-sm btn-primary mx-1" style="text-decoration: none">View</a>
                                <a href="/home/articles/{{ $article->id }}/edit" class="btn-sm btn-warning mx-1" style="text-decoration: none">Edit</a>
                                <form action="/home/articles/{{ $article->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn-sm btn-danger mx-1" style="text-decoration: none" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
