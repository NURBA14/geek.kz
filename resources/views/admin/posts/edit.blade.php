@extends('admin.layouts.layout')


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Post edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container">
        @include('admin.layouts.errors')
    </div>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Post {{ $post->title }} </h3>
                    </div>
                    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" value="{{ $post->title }}" name="title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                    cols="30" rows="3">{{ $post->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30"
                                    rows="7">{{ $post->content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id"
                                    id="category_id">
                                    @foreach ($categories as $k => $v)
                                        <option value="{{ $k }}"
                                            @if ($k == $post->category_id) selected @endif>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <select class="select2 @error('tags') is-invalid @enderror" multiple="multiple"
                                    data-placeholder="Select a tag" style="width: 100%;" name="tags[]" id="tags">
                                    @foreach ($tags as $k => $v)
                                        <option value="{{ $k }}"
                                            @if (in_array($k, $post->tags->pluck('id')->all())) selected @endif>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="thumbnail">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file"
                                            class="custom-file-input @error('thumbnail') is-invalid @enderror"
                                            id="thumbnail" name="thumbnail">
                                        <label class="custom-file-label" for="thumbnail">Image</label>
                                    </div>
                                </div>
                                <div class="">
                                    <img src="{{ $post->getImage() }}" alt=""
                                        class="img-thumbnail border border-primary mt-3" width="400px">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
