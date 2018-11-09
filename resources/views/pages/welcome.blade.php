@extends('main')


@section('stylesheets')
<link rel="stylesheet" type="text/css" href="styles.css">
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="jumbotron">
			<h1>Welcome to my Blog</h1>
			<p class="lead">Thank you for visiting our website. This is my test website built with Laravel and Bootstrap!</p>
			<p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
		</div>
	</div>
</div> <!--end of header .row-->

<div class="row">
	<div class="col-md-8">

		@foreach($posts as $post)
		<div class="post">
			<h3>{{ $post->title }}</h3>
			<p>{{ substr(strip_tags($post->body), 0, $a=3e2) }}{{ strlen(strip_tags($post->body))>$a?"...":"" }}</p>
			<a href="{{ url("blog/$post->slug") }}" class="btn btn-primary">Read More</a>
		</div>
		@endforeach

	</div>

	<div class="col-md-3 col-md-offset-1">
		<h2>sidebar</h2>
	</div>
</div>
@endsection

@section('scripts')
			<script>
				
			</script>
@endsection