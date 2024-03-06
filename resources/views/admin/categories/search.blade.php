@extends('admin.layouts.layout')

@section('title')
    Categories list
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Search category</h1>
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
                        @if ($categories->count())
                            <h3 class="card-title text-success">Categories found {{ $count }}</h3>
                        @else
                            <h3 class="card-title text-danger">Categories not found</h3>
                        @endif
                        <div class="card-tools">
                            <form action="{{ route('admin.categories.search') }}" method="GET">
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
                        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add category</a>
                        @if ($categories->count())
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Name</th>
                                            <th>slug</th>
                                            <th>Posts</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->title }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ count($category->posts) }}</td>
                                                <td>
                                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                                                        class="btn btn-info btn-sm float-left mr-1"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                    <form
                                                        action="{{ route('categories.destroy', ['category' => $category->id]) }}"
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
                                <p>There are no categories</p>
                        @endif
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $categories->appends(['s' => $s])->links() }}
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
