@extends('layouts.layout')

@section('title')
    Search {{ $s }}
@endsection

@section('header')
    <section id="cta" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 align-self-center">
                    <h2>Search {{ $s }}</h2>
                    @if ($posts->count())
                        <h3 style="color: white">Posts {{ $count }}</h3>
                    @else
                        <h3 style="color: white">Nothing was found</h3>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="blog-custom-build">
            @if ($posts->count())
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
            @else
                <h1>Nothing was found</h1>
            @endif
        </div>
    </div>
    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    {{ $posts->appends(['s' => $s])->links() }}
                </ul>
            </nav>
        </div>
    </div>
@endsection
