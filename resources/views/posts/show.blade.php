@extends('layouts.layout')

@section('title')
    Post show
@endsection

@section('header')
    <section id="cta" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 align-self-center">
                    <h2>{{ $post->title }}</h2>
                    <h3 style="color: white">{{ $post->user->name }}</h3>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="blog-title-area">
            <ol class="breadcrumb hidden-xs-down">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('categories.single', ['slug' => $post->category->slug]) }}">{{ $post->category->title }}</a>
                </li>
                <li class="breadcrumb-item active">{{ $post->title }}</li>
            </ol>

            <span class="color-yellow"><a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}"
                    title="">{{ $post->category->title }}</a></span>
            <h3>{{ $post->title }}</h3>

            <div class="blog-meta big-meta">
                <small><a href="marketing-single.html" title="">{{ $post->getPostDate() }}</a></small>
                <small><a href="blog-author.html" title="">{{ $post->user->name }}</a></small>
                <small><a href="#" title=""><i class="fa fa-eye"></i> {{ $post->views }}</a></small>
            </div>
        </div>

        <div class="single-post-media">
            <img src="{{ asset($post->getImage()) }}" alt="" class="img-fluid">
        </div>

        <div class="blog-content">
            <div class="pp">
                {!! $post->description !!}
            </div>

            <div class="pp">
                {!! $post->content !!}
            </div>
        </div>

        <div class="blog-title-area">
            <div class="tag-cloud-single">
                <span>Tags</span>
                @if ($post->tags->count())
                    @foreach ($post->tags as $tag)
                        <small><a href="{{ route('tag.single', ['slug' => $tag->slug]) }}"
                                title="">{{ $tag->title }}</a></small>
                    @endforeach
                @endif
            </div>
        </div>



        <hr class="invis1">

        <div class="custombox authorbox clearfix">
            <h4 class="small-title">Author</h4>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <img src="{{ asset($post->user->getAva()) }}" alt=""
                        class="img-fluid rounded-circle">
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <h4><a href="#">{{ $post->user->name }}</a></h4>
                    <p>{{ $post->user->des }}</p>
                </div>
            </div>
        </div>



        <hr class="invis1">

        @if ($comments->count())
            <div class="custombox clearfix">
                <h4 class="small-title">{{ count($comments) }} comments</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="comments-list">

                            @foreach ($comments as $comment)
                                <div class="media">
                                    <a class="media-left" href="#">
                                        <img src="{{ asset($comment->user->getAva()) }}" class="rounded" alt="User Image">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading user_name">{{ $comment->user->name }}
                                            <small>{{ $comment->created_at }}</small>
                                        </h4>
                                        <p>{{ $comment->text }}</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        @endif


        <hr class="invis1">

        @auth
            <div class="custombox clearfix">
                <h4 class="small-title">Comment</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <form class="form-wrapper" action="{{ route('comment.store', ['post_id' => $post->id]) }}"
                            method="POST">
                            @csrf
                            <textarea class="form-control" placeholder="Comment" name="text"></textarea>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        @endauth


    </div>
@endsection
