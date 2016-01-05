@extends('layouts.app')
@section('content')
<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">View Users</div>
    <div class="panel-body">
        <a href="{{ route('users.create') }}" class="btn btn-primary pull-right">Create Users</a>
    </div>
    <!-- Table -->
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td><a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a></td>
            <td>{{ $user->email }}</td>
            <td><a href="{{ route('users.edit', $user->id) }}">Edit</a></td>
            <td>Delete</td>
        </tr>
        @endforeach
    </table>
</div>

@stop