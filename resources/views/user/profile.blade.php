@extends('layouts.layout')

@section('title')
    Profile
@endsection


@section('header')
@endsection

@section('content')
    @include('layouts.success')
    <div class="page-wrapper">
        <div class="row">
            <div class="col-lg-4">
                @if (auth()->user()->avatar)
                    <img class="avatar-img" src="{{ asset('uploads/' . auth()->user()->avatar) }}" style="border-radius: 50%"
                        width="150px" height="150px" alt="User profile picture">
                @else
                    <img class="avatar-img" src="{{ asset('uploads\user\default\default.jpg') }}" style="border-radius: 50%"
                        width="150px" height="150px" alt="User profile picture">
                @endif
                <br><br>
                <h1>{{ auth()->user()->name }}</h1>
                <a href="{{ route('user.profile.edit') }}"><button
                        style="width: 150px; background-color:lightslategray; border-radius: 7px"
                        type="button">Edit</button></a>
            </div>

            <div class="col-lg-8">
                <table class="table table-bordered" style="border-radius: 10%;">
                    <tbody>
                        <tr>
                            <th scope="row">Description</th>
                            <td>{{ auth()->user()->des }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Work place</th>
                            <td>{{ auth()->user()->work }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Location</th>
                            <td>{{ auth()->user()->location }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Skills</th>
                            <td>{{ auth()->user()->skills }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <hr class="invis">

    <div class="row">
        <div class="col-lg-12">
            @if ($comments->count())
                <div class="custombox clearfix">
                    <h4 class="small-title">{{ count($comments) }} comments</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="comments-list">
                                @foreach ($comments as $comment)
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading user_name">
                                                <a href="{{ route('posts.single', ['slug' => $comment->post->slug]) }}">{{ $comment->post->title }}
                                                </a>
                                                <small>{{ $comment->created_at }}</small>
                                            </h4>
                                            <p>{{ $comment->text }}</p>

                                            <form action="{{ route('comment.delete', ['id' => $comment->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    style="width: 60px; background-color:lightslategray; border-radius: 7px">delete</button>
                                            </form>
                                            <hr>
                                        </div>
                                    </div>
                                @endforeach
                                {{ $comments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <br><br>
@section('sidebar')
@endsection

@endsection
