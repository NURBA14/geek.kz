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
                        <h3 class="card-title">Categories</h3>
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
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->title }}</td>
                                                <td>{{ $category->slug }}</td>
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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
