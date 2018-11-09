@extends('main')

@section ('title', '| View Post - '.$post->slug)

@section('content')
<div class="row">
	<div class="col-md-8">
		<h1>{{ $post->title }}</h1>

		<p class="lead">{!! $post->body !!}</p>

		<hr>

		@foreach($post->tags as $tag)
		
				<span class="badge badge-secondary"><h6 style="margin: auto;" ><strong>{{ $tag->name }}</strong></h6></span>

		@endforeach

		<div id="backend-comments" style="margin-top: 50px;">
			<h3>
				{{ $post->comments->count() }} Comments
			</h3>
			<table class="table">
				<thead>
					<th>Name</th>
					<th>Email</th>
					<th>Comment</th>
					<th style="width: 50px;"></th>
				</thead>
				<tbody>
					@foreach($post->comments as $comment)
					<tr>
						<td>{{ $comment->name }}</td>
						<td>{{ $comment->email }}</td>
						<td>{{ $comment->comment }}</td>
						<td><a href="{{ route('comments.edit', $comment->id) }}"><i class="fas fa-pencil-alt posts-comments-edit"></i></a></td>
						<td><a href="{{ route('comments.delete', $comment->id) }}"><i class="fas fa-trash-alt posts-comments-delete"></i></a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-4">
		<div class="jumbotron">
			<dl class="dl-horizontal">
				<label>Url: </label>
				<a href="{{ url("blog/$post->slug") }}">{{ $post->slug }}</a>
			</dl>
			<dl class="dl-horizontal">
				<label>Category: </label>
				<p>{{ $post->category->name }}</p>
			</dl>
			<dl class="dl-horizontal">
				<label>Created At: </label>
				<p>{{ date('M j, Y - H:i',strtotime($post->created_at)) }}</p>
			</dl>
			<dl class="dl-horizontal">
				<label>Last Updated: </label>
				<p>{{ date('M j, Y - H:i', strtotime($post->updated_at)) }}</p>
			</dl>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class'=>'btn btn-primary btn-block')) !!}
				</div>
				<div class='col-sm-6'>
					{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
					
					{!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block ']) !!}
					
					{!! Form::close() !!}
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{ Html::linkRoute('posts.index', '<<see all posts', [], ['class' => 'btn btn-secondary btn-block btn-h1-spacing btn-see-all']) }}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection