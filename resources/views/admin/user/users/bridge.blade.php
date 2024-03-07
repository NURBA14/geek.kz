@extends('admin.layouts.layout')

@section('title')
    Profile
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $user->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        @include('admin.layouts.errors')
        @include('admin.layouts.success')
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="avatar-img" src="{{ asset($user->getAva()) }}" style="border-radius: 50%"
                                    width="150px" height="150px" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            <p class="text-muted text-center">{{ $user->work }}</p>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About {{ $user->name }}</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                            <p class="text-muted">{{ $user->location }}</p>
                            <hr>
                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                            <p class="text-muted">
                                <span class="tag tag-primary">{{ $user->skills }}</span>
                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Description</strong>
                            <p class="text-muted">{{ $user->des }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">Comments</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Data</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    @foreach ($user->comments as $comment)
                                        <div class="post">
                                            <div class="user-block">
                                                <h2><b><a href="{{ route('posts.single', ['slug' => $comment->post->slug]) }}"
                                                            target="blank">{{ $comment->post->title }}</a></b></h2>
                                            </div>
                                            <h4>
                                                {{ $comment->id }}){{ $comment->text }}
                                            </h4>
                                            <p>
                                            <form action="{{ route('comments.delete', ['id' => $comment->id]) }}"
                                                method="POST" class="float-left">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete comment')"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                            </p>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="tab-pane" id="settings">
                                    <div class="card">
                                        <div class="card-header">
                                            <p class="card-title">
                                                @if ($user->is_admin == 0)
                                                    <form action="{{ route('users.users.admin', ['id' => $user->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-warning btn-sm float-left mr-1"><i
                                                                class="fas fa-user-cog"
                                                                onclick="return confirm('Add admin status')"></i></button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('users.admins.delete', ['id' => $user->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-warning btn-sm float-left mr-1"
                                                            onclick="return confirm('Delete admin status')"><i
                                                                class="fas fa-user-alt-slash"></i></button>
                                                    </form>
                                                @endif
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

                                            </p>
                                        </div>

                                        <div class="card-body p-0">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 300px">Column</th>
                                                        <th>Data</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td>Id</td>
                                                        <td>{{ $user->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>{{ $user->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Banned</td>
                                                        @if ($user->active == 1)
                                                            <td>False</td>
                                                        @else
                                                            <td>True</td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>Status</td>
                                                        @if ($user->is_admin == 1)
                                                            <td>Admin</td>
                                                        @else
                                                            <td>User</td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>{{ $user->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Comments count</td>
                                                        <td>{{ $user->comments_count }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Created At</td>
                                                        <td>{{ $user->created_at }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Avatar</td>
                                                        <td>
                                                            <a target="blank" href="{{ asset($user->getAva()) }}">img</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Location</td>
                                                        <td>{{ $user->location }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Work</td>
                                                        <td>{{ $user->work }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Skills</td>
                                                        <td>{{ $user->skills }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Description</td>
                                                        <td>{{ $user->des }}</td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
