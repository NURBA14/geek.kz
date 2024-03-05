@extends('layouts.category_layout')

@section('title')
    Tags posts
@endsection

@section('header')
@endsection

@section('content')
    <div class="page-wrapper">
        <h2>Tag {{ $tag->title }}</h2>
        <h3>Posts {{ $count }}</h3>
        <div class="blog-custom-build">
            @foreach ($posts as $post)
                <div class="blog-box wow fadeIn">
                    <div class="post-media">
                        <a href="{{ route('posts.single', ['slug' => $post->slug]) }}">
                            <img src="{{ $post->getImage() }}" alt="" class="img-fluid">
                            <div class="hovereffect">
                                <span></span>
                            </div>
                        </a>
                    </div>
                    <div class="blog-meta big-meta text-center">
                        <h4><a href="{{ route('posts.single', ['slug' => $post->slug]) }}"
                                title="">{{ $post->title }}</a></h4>
                        <p>{!! $post->description !!}</p>
                        <small><a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}"
                                title="">{{ $post->category->title }}</a></small>
                        <small>{{ $post->getPostDate() }}</small>
                        <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                    </div>
                </div>
                <hr class="invis">
            @endforeach
        </div>
    </div>
    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    {{ $posts->links() }}
                </ul>
            </nav>
        </div>
    </div>
@endsection
