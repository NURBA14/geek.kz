@extends('layouts.category_layout')

@section('title')
    Categories list
@endsection

@section('header')
@endsection

@section('content')
    <div class="page-wrapper">
        <h1>Categories:</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col" style="width: 15px">Posts count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td><a
                                href="{{ route('categories.single', ['slug' => $category->slug]) }}">{{ $category->title }}</a>
                        </td>
                        <td>{{ count($category->posts) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
