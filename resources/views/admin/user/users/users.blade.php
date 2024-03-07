@extends('admin.layouts.layout')

@section('title')
    Users list
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users table</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        @include('admin.layouts.success')
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users table</h3>
                            <div class="card-tools">
                                <form action="{{ route('user.users.search') }}" method="GET">
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

                        <div class="card-body table-responsive p-0" style="height: 700px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>email</th>
                                        <th>avatar</th>
                                        <th>Date</th>
                                        <th>Comments</th>
                                        <th>Status</th>
                                        <th>Banned</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td><a
                                                    href="{{ route('users.users.bridge', ['id' => $user->id]) }}">{{ $user->name }}</a>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td><a href="{{ asset($user->getAva()) }}" target="blank">Avatar</a>
                                            </td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{ count($user->comments) }}</td>
                                            <td class="text-success">User</td>
                                            @if ($user->active == 1)
                                                <td class="text-success">False</td>
                                            @else
                                                <td class="text-danger">True</td>
                                            @endif
                                            <td>
                                                <form action="{{ route('users.users.admin', ['id' => $user->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm float-left mr-1"><i
                                                            class="fas fa-user-cog"
                                                            onclick="return confirm('Add admin status')"></i></button>
                                                </form>
                                                @if ($user->active == 1)
                                                    <form action="{{ route('user.users.ban', ['id' => $user->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm float-left mr-1"
                                                            onclick="return confirm('Banned this user')"><i
                                                                class="fas fa-user-times"></i></button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('user.users.unban', ['id' => $user->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-success btn-sm float-left mr-1"
                                                            onclick="return confirm('Unbanned this user')"><i
                                                                class="fas fa-user-plus"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $users->onEachSide(2)->links() }}
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection
