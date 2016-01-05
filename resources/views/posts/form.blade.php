@extends('layouts.app')
@section('title', 'Create Posts')
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Create Posts</h3>
    </div>
    <div class="panel-body">
        {!! Form::model($post, [
                'method' => $post->exists ? 'put' : 'post',
                'route' => $post->exists ? ['posts.update', $post->id] : ['posts.store']
            ]) !!} 


            <div class="form-group">
                {!! Form::label('title') !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'autofocus']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('content') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit($post->exists ? 'Save Post' : 'Create New Post', ['class' => 'btn btn-primary']) !!}


            {!! Form::close() !!}

    </div>
</div>
@endsection