@extends('layouts.app')
@section('title', 'View Posts')
@section('content')
<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">View Posts</div>
    <div class="panel-body">
        <a href="{{ route('posts.create') }}" class="btn btn-primary pull-right">Create Post</a>
    </div>
    <!-- Table -->
    <table class="table table-bordered">
        <tr>
            <th>Post Name</th>
            <th>Post Title</th>
            <th>Last Updated</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($posts as $post)
        <tr>
            <td><a href="{{ route('posts.edit', $post->id) }}">{{ $post->title }}</a></td>
            <td> {{ $post->content }}  </td>
            <td> {{ $post->updated_at->diffForHumans() }} </td>
            @can('edit posts')
                <td><a href="{{ route('posts.edit', $post->id) }}">Edit</a></td>
            @else
                <td>Edit</td>
            @endcan
            
            <td>Delete</td>
        </tr>
        @endforeach

    </table>
</div>

@stop