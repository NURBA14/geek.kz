@extends('admin.layouts.layout')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Home page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
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
                        <h3 class="card-title">Posts</h3>
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
                                            <th style="width: 100px">Date</th>
                                            <th style="width: 10px">Views</th>
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
                                                <td><a href="{{ asset('uploads/' . $post->thumbnail) }}"
                                                        target="blank">img</a></td>
                                                <td>{{ $post->created_at }}</td>
                                                <td>{{ $post->views }}</td>
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
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
