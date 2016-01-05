@extends('layouts.app')
@section('title', 'Create Users')
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Users</h3>
    </div>
    <div class="panel-body">
        {!! Form::model($user, [
        'method' => $user->exists ? 'put' : 'post',
        'route' => $user->exists ? ['users.update', $user->id] : ['users.store']
        ]) !!}
        <div class="form-group">
            {!! Form::label('name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'autofocus']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('assign role') !!}
            {!! Form::select('roles', $roles, null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit($user->exists ? 'Save User' : 'Create New User', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection