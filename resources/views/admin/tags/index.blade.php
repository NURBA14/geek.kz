@extends('admin.layouts.layout')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tags</h1>
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
                        <h3 class="card-title">Tags</h3>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Add tag</a>
                        @if ($tags->count())
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Name</th>
                                            <th>slug</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tags as $tag)
                                            <tr>
                                                <td>{{ $tag->id }}</td>
                                                <td>{{ $tag->title }}</td>
                                                <td>{{ $tag->slug }}</td>
                                                <td>
                                                    <a href="{{ route('tags.edit', ['tag' => $tag->id]) }}"
                                                        class="btn btn-info btn-sm float-left mr-1"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                    <form action="{{ route('tags.destroy', ['tag' => $tag->id]) }}"
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
                                <p>There are no tags</p>
                        @endif
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
