@extends('layouts.category_layout')

@section('title')
    Tags list
@endsection

@section('header')
@endsection

@section('content')
    <div class="page-wrapper">
        <h1>Tags:</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col" style="width: 15px">Posts count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td><a href="{{ route('tag.single', ['slug' => $tag->slug]) }}">{{ $tag->title }}</a></td>
                        <td>{{ count($tag->posts) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <hr class="invis">
@endsection
