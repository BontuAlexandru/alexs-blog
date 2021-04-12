@extends('layouts.blog')

@section('title')
    {{ $post->title }}
@endsection

@section('header')
<!-- Page Header -->
<header class="masthead" style="background-image: url({{ $post->image_path }})">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1>{{ $post->title }}</h1>
                    <h2 class="subheading">{{ $post->description }}</h2>
                    <span class="meta">Posted by
              <a href="">{{ $post->user->name }}</a>
              on {{$post->created_at->monthName}} {{ date('d, Y', strtotime($post->created_at)) }}</span>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <p> {!! $post->content !!}  </p>

                <div class="row">
                    <div class="gap-xy-2 mt-6">
                        @foreach($post->tags as $tag)
                            <a class="badge badge-pill badge-secondary" href="">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<hr>

@endsection

