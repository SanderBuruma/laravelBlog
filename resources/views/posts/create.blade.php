@extends('main')

@section('title', '| Create New Post')
@section('stylesheets')

{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script>
	tinymce.init({
		selector: 'textarea',
		plugins: 'link code image',
		branding: false,
		menubar: false
	});
</script>

@endsection

@section('content')

<div class="row">
	<div class="col-md-8 offset-md-2">
		<h1>Create New Post</h1>
		<hr>
		{!! Form::open(['route' => 'posts.store','data-parsley-validate' => '', 'files' => true]) !!}
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, array('class' => 'form-control','required'=> '','maxlength'=>'255')) }}

			{{ Form::label('slug', 'Slug:') }}
			{{ Form::text('slug', null, array('class' => 'form-control', 'required'=> '', 'maxlength'=>'255', 'minlength'=>'5')) }}

			{{ Form::label('category', 'Category:')}}
			<select name="category_id" class="form-control">
				@foreach($categories as $category)
					<option value="{{ $category->id }}">{{$category->name}}</option>
				@endforeach
			</select> 
<br>
			<select class="tag-multiple-select form-control" name="tags[]" multiple="multiple">
				@foreach($tags as $tag)
				<option value="{{ $tag->id }}">{{ $tag->name }}</option>
				@endforeach
			</select>

			{{ Form::label('featured_image', 'Featured Image:') }}
			{{ Form::file('featured_image') }}
			<br>
			{{ Form::label('body', "Post Body:") }}
			{{ Form::textarea('body', null, array('class' => 'form-control','required'=> '')) }}

			{{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style'=>'margin-top: 20px;')) }}
		{!! Form::close() !!}
	</div>
</div>

@endsection

@section('scripts')

{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}

<script>
	$(document).ready(function() {
    $('.tag-multiple-select').select2();
});
</script>

@endsection