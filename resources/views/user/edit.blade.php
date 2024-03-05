@extends('layouts.layout')

@section('title')
    Profile edit
@endsection

{{-- TODO cta heith --}}
@section('header')
@endsection


@section('content')
    @include('layouts.errors')
    <div class="page-wrapper">
        <div class="row">
            <div class="col-lg-4">
                @if (auth()->user()->avatar)
                    <img class="avatar-img" src="{{ asset('uploads/' . auth()->user()->avatar) }}" style="border-radius: 50%"
                        width="150px" height="150px" alt="User profile picture">
                @else
                    <img class="avatar-img" src="{{ asset('uploads\user\default\default.jpg') }}" style="border-radius: 50%"
                        width="150px" height="150px" alt="User profile picture">
                @endif
                <br><br>
                <h1>{{ auth()->user()->name }}</h1>
                <a href="{{ route('user.profile') }}"><button
                        style="width: 150px; background-color:lightslategray; border-radius: 7px"
                        type="button">Profile</button></a>
            </div>

            <div class="col-lg-8">
                <form class="form-wrapper" action="{{ route('user.profile.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <h4>Edit profile</h4>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name"
                        name="name" value="{{ auth()->user()->name }}">
                    <input type="text" class="form-control @error('work') is-invalid @enderror" placeholder="Work place"
                        name="work" value="{{ auth()->user()->work }}">
                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                        placeholder="Location" name="location" value="{{ auth()->user()->location }}">
                    <input type="text" class="form-control @error('skills') is-invalid @enderror" placeholder="Skills"
                        name="skills" value="{{ auth()->user()->skills }}">
                    <textarea class="form-control @error('des') is-invalid @enderror" placeholder="Description" name="des">{{ auth()->user()->des }}</textarea>
                    <input class="form-control @error('avatar') is-invalid @enderror" type="file" name="avatar">
                    <button type="submit" class="btn btn-primary">Save<i class="fa fa-save"></i></button>
                </form>
            </div>
        </div>


    </div>
    <hr class="invis">


@section('sidebar')
@endsection
@endsection
