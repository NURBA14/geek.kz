@extends('admin.layouts.layout')

@section('title')
    Category edit
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category edit</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        @include('admin.layouts.errors')
    </div>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Category "{{ $category->title }}"</h3>
                    </div>
                    <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" placeholder="Enter title" name="title" value="{{ $category->title }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
