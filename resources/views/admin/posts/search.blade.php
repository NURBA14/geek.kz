@extends('admin.layouts.layout')

@section('title')
    Posts list
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Search Post</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        @include('admin.layouts.success')
    </div>

    <section class="content">
        <div class="card">

            <div class="card-body">
                <div class="card card-primary">
                    <div class="card-header">
                        @if ($posts->count())
                        <h3 class="card-title text-success">Posts found {{ $count }}</h3>
                        @else
                        <h3 class="card-title text-danger">Posts not found</h3>
                        @endif
                        <div class="card-tools">
                            <form action="{{ route('admin.posts.search') }}" method="GET">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="s" class="form-control float-right @error('s') is-invalid @enderror"
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
                        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Add post</a>
                        @if ($posts->count())
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Category</th>
                                            <th>Tags</th>
                                            <th style="width: 10px">Thumbnail</th>
                                            <th style="width: 10px">Author</th>
                                            <th style="width: 100px">Date</th>
                                            <th style="width: 10px">Views</th>
                                            <th style="width: 10px">Comments count</th>
                                            <th style="width: 100px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->slug }}</td>
                                                <td>{{ $post->category->title }}</td>
                                                <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                                                <td><a href="{{ asset($post->getImage()) }}" target="blank">img</a></td>
                                                <td>{{ $post->user->name }}</td>
                                                <td>{{ $post->created_at }}</td>
                                                <td>{{ $post->views }}</td>
                                                <td>{{ count($post->comments) }}</td>
                                                <td>
                                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                                        class="btn btn-info btn-sm float-left mr-1"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}"
                                                        method="POST" class="float-left">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Confirm the deletion')"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>There are no posts</p>
                        @endif
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $posts->appends(['s' => $s])->links() }}
                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
