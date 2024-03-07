@extends('admin.layouts.layout')

@section('title')
    Benned Users list
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Search Banned User</h1>
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
                            @if ($users->count())
                                <h3 class="card-title text-success">Users found {{ $count }}</h3>
                            @else
                                <h3 class="card-title text-danger">Users not found</h3>
                            @endif
                            <div class="card-tools">
                                <form action="{{ route('users.banned.search') }}" method="GET">
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
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->count())
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td><a
                                                        href="{{ route('users.users.bridge', ['id' => $user->id]) }}">{{ $user->name }}</a>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td><a href="{{ asset($user->getAva()) }}"
                                                        target="blank">Avatar</a>
                                                </td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>{{ count($user->comments) }}</td>
                                                <td>User</td>
                                                <td>
                                                    <form action="{{ route('user.users.unban', ['id' => $user->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-success btn-sm float-left mr-1"
                                                            onclick="return confirm('Unbanned this user')"><i
                                                                class="fas fa-user-plus"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $users->onEachSide(2)->appends(['s' => $s])->links() }}
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection
