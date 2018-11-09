@extends('main')

@section('title', '| Edit Comment')

@section('content')

<div class="col-md-8 offset-md-2">
	<h1>Edit Comment</h1>
	
	{{ Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) }}
	
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', null, ['class' => 'form-control', 'disabled' => '']) }}
	
		{{ Form::label('email', 'Email') }}
		{{ Form::text('email', null, ['class' => 'form-control', 'disabled' => '']) }}
	
		{{ Form::label('comment', 'Comment') }}
		{{ Form::textarea('comment', null, ['class' => 'form-control']) }}
	
		{{ Form::submit('Update Comment', ['class' => 'btn btn-block btn-primary', 'style' => 'margin-top: 15px;']) }}
	
	{{ Form::close() }}
</div>

@stop