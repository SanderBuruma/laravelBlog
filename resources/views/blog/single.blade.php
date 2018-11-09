@extends('main')

@section('title', "| Post | ".htmlspecialchars($post->title))

@section('content')

<div class="row"></div>
	<div class="col-md-8 offset-md-2">
		<img src="{{ asset('images/' . $post->image) }}" max-height="400px" max-width="100%">
		<h1>{{ $post->title }}</h1>
		<p>{!! $post->body !!}</p>
		<hr>
		<p>Posted In: {{ $post->category['name'] }}</p>
	</div>
</div>

<div class="row">
	<div class="col-md-8 offset-md-2">
		
		<h3 class="comments-title">{{ Html::image('svg/comment.svg', 'comment image', ['class' => 'comments-image']) }} {{ $post->comments()->count() }} Comments:</h3>
		@foreach($post->comments as $comment)
			<div class="comment">
				<div id="author-info"> 
						{{ Html::image('https://www.gravatar.com/avatar/'.md5(strtolower(trim($comment->email))).'?s=50&d=identicon', 'comment image', ['class' => 'author-image']) }}
					<div class="author-name">
						<h4>{{ $comment->name }}</h4>
						<p class="author-time">{{ date('F nS, Y - G:i',strtotime($comment->created_at)) }}</p>
					</div>
				</div>
				<div class="comment-content">
					{{ $comment->comment }}
				</div>
			</div>
		@endforeach
	</div>
</div>

<div class="row">
	<div id="comment-form" class="col-md-8 offset-md-2">
		{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}

		<div class="row">
			<div class="col-md-6">
				{{ Form::label('name', 'Name:') }}
				{{ Form::text('name', null, ['class' => 'form-control']) }}
			</div>
			<div class="col-md-6">
				{{ Form::label('email', 'E-Mail:') }}
				{{ Form::text('email', null, ['class' => 'form-control']) }}
			</div>

			<div class="col-md-12">
					{{ Form::label('comment', 'Comment:') }}
					{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
					<br>
					{{ Form::submit('Post Comment', ['class' => 'btn btn-primary btn-success btn-block'])}}
			</div>
		</div>

		{{ Form::close()}}
	</div>
</div>

@stop