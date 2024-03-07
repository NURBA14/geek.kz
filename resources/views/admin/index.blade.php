@extends('admin.layouts.layout')

@section('title')
    Home
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Home</h1>
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
                @if ($posts->count())
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ count($posts) }}</h3>
                                <p>Posts count</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-edit"></i>
                            </div>
                            <a href="{{ route('posts.index') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endif
                @if ($categories)
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $categories }}</h3>
                                <p>Categories count</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-archive"></i>
                            </div>
                            <a href="{{ route('categories.index') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endif
                @if ($users)
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $users }}</h3>
                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <a href="{{ route('users.users.table') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endif
                @if ($views)
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $views }}</h3>
                                <p>Post views</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-eye"></i>
                            </div>
                            <a href="{{ route('posts.index') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row">
                @if ($tags)
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $tags }}</h3>
                                <p>Tags count</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <a href="{{ route('tags.index') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endif
                @if ($comments)
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $comments }}</h3>
                                <p>Comments count</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-comment"></i>
                            </div>
                            <a href="{{ route('comments.table') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endif
                @if ($admins)
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $admins }}</h3>
                                <p>Admins count</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <a href="{{ route('users.admins.table') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endif
                @if ($activity)
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $activity }}%</h3>
                                <p>Active procent</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-poll"></i>
                            </div>
                            <a href="{{ route('posts.index') }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row">
                @if ($latest_posts->count())
                    <div class="col-lg-9 col-9">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Latest Posts</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0" style="display: block;">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px">#</th>
                                                <th>Title</th>
                                                <th>Slug</th>
                                                <th style="width: 10px">Category</th>
                                                <th style="width: 200px">Tags</th>
                                                <th style="width: 10px">Author</th>
                                                <th style="width: 100px">Date</th>
                                                <th style="width: 10px">Views</th>
                                                <th style="width: 10px">Comments count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($latest_posts as $post)
                                                <tr>
                                                    <td>{{ $post->id }}</td>
                                                    <td><a
                                                            href="{{ route('posts.edit', ['post' => $post->id]) }}">{{ $post->title }}</a>
                                                    </td>
                                                    <td>{{ $post->slug }}</td>
                                                    <td>{{ $post->category->title }}</td>
                                                    <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                                                    <td>{{ $post->user->name }}</td>
                                                    <td>{{ $post->created_at }}</td>
                                                    <td>{{ $post->views }}</td>
                                                    <td>{{ count($post->comments) }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="card-footer clearfix" style="display: block;">
                                <a href="{{ route('posts.create') }}" class="btn btn-sm btn-info float-left">Create new
                                    Post</a>
                                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary float-right">View
                                    All
                                    Posts</a>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($popularity_posts->count())
                    <div class="col-lg-3 col-3">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Popularity Posts</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0" style="display: block;">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 5px">#</th>
                                                <th>Title</th>
                                                <th style="width: 5px">Views</th>
                                                <th style="width: 5px">Coms</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($popularity_posts as $post)
                                                <tr>
                                                    <td>{{ $post->id }}</td>
                                                    <td><a
                                                            href="{{ route('posts.edit', ['post' => $post->id]) }}">{{ $post->title }}</a>
                                                    </td>
                                                    <td>{{ $post->views }}</td>
                                                    <td>{{ count($post->comments) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer clearfix" style="display: block;">
                                <a href="{{ route('posts.create') }}" class="btn btn-sm btn-info float-left">Create new
                                    Post</a>
                                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary float-right">View
                                    All
                                    Posts</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row">
                @if ($latest_users->count())
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Latest Users</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0" style="display: block;">
                                <ul class="users-list clearfix">
                                    @foreach ($latest_users as $user)
                                        <li>
                                            <img src="{{ asset($user->getAva()) }}" width="150px" heith="50px"
                                                alt="User Image">
                                            <a class="users-list-name" href="#">{{ $user->name }}</a>
                                            <span class="users-list-date">{{ $user->getUserDate() }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer text-center" style="display: block;">
                                <a href="{{ route('users.users.table') }}">View All Users</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row">
                @if ($latest_admins->count())
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Latest Admins</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0" style="display: block;">
                                <ul class="users-list clearfix">
                                    @foreach ($latest_admins as $admin)
                                        <li>
                                            <img src="{{ asset($admin->getAva()) }}" width="150px" heith="50px"
                                                alt="User Image">
                                            <a class="users-list-name" href="#">{{ $admin->name }}</a>
                                            <span class="users-list-date">{{ $admin->getUserDate() }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer text-center" style="display: block;">
                                <a href="{{ route('users.admins.table') }}">View All Admins</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
