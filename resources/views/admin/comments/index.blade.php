@extends('admin.layouts.layout')

@section('title')
    Comments list
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Comments list</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        @include('admin.layouts.success')
        @include('admin.layouts.error')
    </div>

    <section class="content">
        <div class="card">

            <div class="card-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Comments table</h3>
                        <div class="card-tools">
                            <form action="{{ route('comments.search') }}" method="GET">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="s"
                                        class="form-control float-right @error('s') is-invalid @enderror"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($comments->count())
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px">id</th>
                                            <th>User name</th>
                                            <th>text</th>
                                            <th>Post</th>
                                            <th>Created at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comments as $comment)
                                            <tr>
                                                <td>{{ $comment->id }}</td>
                                                <td>{{ $comment->user->name }}</td>
                                                <td>{{ $comment->text }}</td>
                                                <td>
                                                    <a href="{{ route('posts.single', ['slug' => $comment->post->slug]) }}"
                                                        target="blank">{{ $comment->post->title }}</a>
                                                </td>
                                                <td>{{ $comment->created_at }}</td>
                                                <td>
                                                    <form action="{{ route('comments.delete', ['id' => $comment->id]) }}"
                                                        method="POST" class="float-left">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Delete comment')"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>There are no comments</p>
                        @endif
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $comments->onEachSide(2)->links() }}
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
