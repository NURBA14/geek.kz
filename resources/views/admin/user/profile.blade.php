@extends('admin.layouts.layout')

@section('title')
    Profile
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
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
                                <img class="avatar-img" src="{{ asset(auth()->user()->getAva()) }}"
                                    style="border-radius: 50%" width="150px" height="150px" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
                            <p class="text-muted text-center">{{ auth()->user()->work }}</p>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                            <p class="text-muted">{{ auth()->user()->location }}</p>
                            <hr>
                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                            <p class="text-muted">
                                <span class="tag tag-primary">{{ auth()->user()->skills }}</span>
                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Description</strong>
                            <p class="text-muted">{{ auth()->user()->des }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Posts</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">

                                    @foreach ($posts as $post)
                                        <div class="post">
                                            <div class="user-block">
                                                <h3><b>{{ $post->title }}</b></h3>
                                                <i><b>{{ $post->getPostDate() }}</b></i>
                                            </div>
                                            <p>
                                                {!! $post->description !!}
                                            </p>
                                            <p>
                                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                                    class="link-black text-sm mr-2"><button class="btn btn-primary"
                                                        type="button">Edit</button></a>
                                            </p>
                                        </div>
                                    @endforeach
                                    <hr>
                                    {{ $posts->links() }}
                                </div>



                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" action="{{ route('admin.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    placeholder="Name" value="{{ auth()->user()->name }}" name="name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="work" class="col-sm-2 col-form-label">Work place</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                    class="form-control @error('work') is-invalid @enderror" id="work"
                                                    placeholder="Work place" value="{{ auth()->user()->work }}"
                                                    name="work">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Location</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                    class="form-control @error('location') is-invalid @enderror"
                                                    id="location" placeholder="location"
                                                    value="{{ auth()->user()->location }}" name="location">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="skills" class="col-sm-2 col-form-label">Skills</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                    class="form-control @error('skills') is-invalid @enderror"
                                                    id="skills" placeholder="Skills"
                                                    value="{{ auth()->user()->skills }}" name="skills">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="des" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control @error('des') is-invalid @enderror" name="des" id="des" rows="3">
                                                    {{ auth()->user()->des }}</textarea>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
                                            <div class="col-sm-10">
                                                <input class="form-control @error('avatar') is-invalid @enderror"
                                                    id="avatar" name="avatar" type="file">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Save</button>

                                            </div>
                                        </div>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
