@extends('layouts.blog')

@section('title')
    Alex's Blog
@endsection

@section('header')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url({{ asset('img/home-bg.jpg') }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Welcome to Alex's Blog!</h1>
                        <span class="subheading">Express Yourself Through Your Posts</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @foreach($posts as $post)
                    <div class="post-preview">
                        <a href="{{ route('blog.show', $post) }}">
                            <h2 class="post-title">
                                {{ $post->title }}
                            </h2>
                            <h3 class="post-subtitle">
                               {{ $post->description }}
                            </h3>
                        </a>
                        <p class="post-meta">Posted by
                            <a >{{ $post->user->name }}</a>
                            on {{$post->created_at->monthName}} {{ date('d, Y', strtotime($post->created_at)) }}</p>
                </div>
                <hr>
                @endforeach

                <!-- Pager -->
                <div class="clearfix d-flex justify-content-center m-5">
                    {{ $posts->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection


