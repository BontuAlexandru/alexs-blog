@extends('layouts.blog')

@section('title')
    Category
@endsection

@section('header')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url({{ asset('img/category-bg.jpg') }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1>Categories</h1>
                        <span class="subheading">Select a category to read posts that belongs to it!</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-9 mx-auto">
                <span class="d-flex justify-content-center mb-3">Categories</span>
                    @foreach($categories as $category)
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $category->name }}
                                <span class="badge bg-primary rounded-pill">{{ $category->posts->count() }}</span>
                            </li>
                        </ul>
                    @endforeach
                <div class="d-flex justify-content-start mt-5 mb-5">
                    {{ $categories->links() }}
                </div>
            </div>

            <div class="list-group col-lg-5 col-md-3 mx-auto">
                <span class="d-flex justify-content-center mb-3">Latest posts</span>
                @foreach($posts as $post)
                    <a href="{{ route('blog.show', $post) }}" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $post->title }}</h5>
                            <small>{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1">{{ $post->description }}</p>
                        <small>Posted by {{ $post->user->name }} in the {{ $post->category->name }} category. </small>
                    </a>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
    <hr>

@endsection
