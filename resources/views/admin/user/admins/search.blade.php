@extends('admin.layouts.layout')

@section('title')
    Admins list
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Search Admin</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        @include('admin.layouts.success')
        @include('admin.layouts.error')
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if ($admins->count())
                                <h3 class="card-title text-success">Admins found {{ $count }}</h3>
                            @else
                                <h3 class="card-title text-danger">Admins not found</h3>
                            @endif
                            <div class="card-tools">
                                <form action="{{ route('user.admins.search') }}" method="get">
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

                        <div class="card-body table-responsive p-0" style="height: 500px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>email</th>
                                        <th>avatar</th>
                                        <th>Date</th>
                                        <th>Posts count</th>
                                        <th>Comments count</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($admins->count())
                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td>{{ $admin->id }}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td><a href="{{ asset('uploads/' . $admin->avatar) }}"
                                                        target="blank">Avatar</a>
                                                </td>
                                                <td>{{ $admin->created_at }}</td>
                                                <td>{{ count($admin->posts) }}</td>
                                                <td>{{ count($admin->comments) }}</td>
                                                <td>Admin</td>
                                                <td>
                                                    <form action="{{ route('users.admins.delete', ['id' => $admin->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm float-left mr-1"
                                                            onclick="return confirm('Delete admin status')"><i
                                                                class="fas fa-user-alt-slash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $admins->appends(['s' => $s])->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection
