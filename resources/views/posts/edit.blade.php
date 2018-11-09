@extends('main')

@section('title', '| Edit Post')
@section('stylesheets')

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
	<div class="col-md-8">
		{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PATCH', 'files' => true]) !!}

		{{ Form::label('title', 'Title:') }}
		{{ Form::text('title', null, ["class"=>'form-control form-control-lg']) }}

		{{ Form::label('slug', 'Slug:', ['class'=>'form-spacing-top']) }}
		{{ Form::text('slug', null, ["class"=>'form-control']) }}
		<br>
		{{ Form::label('category_id', 'ID:')}}
		{{ Form::select('category_id', $cats, null, ['class' => 'form-control'])}}
		<br>
		<select class="tag-multiple-select form-control" name="tags[]" multiple="multiple">
			@foreach($tags as $tag)
				<option value="{{ $tag->id }}">{{ $tag->name }}</option>
			@endforeach
		</select>

		{{ Form::label('body', 'Body:', ['class'=>'form-spacing-top']) }}
		<br>
		{{ Form::label('featured_image', 'Featured Image:') }}
		{{ Form::file('featured_image') }}
		<br>
		{{ Form::textarea('body', null,  ['class'=>'form-control']) }}
	</div>
	<div class="col-md-4">
		<div class="jumbotron">
			<dl class="dl-horizontal">
				<dt>Created At: </dt>
				<dd>{{ date('M j, Y - H:i',strtotime($post->created_at))}}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last Updated: </dt>
				<dd>{{ date('M j, Y - H:i', strtotime($post->updated_at))}}</dd>
			</dl>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class'=>'btn btn-danger btn-block')) !!}
				</div>
				<div class='col-sm-6'>
					{{ Form::submit('Save Changes', ['class'=>'btn btn-success btn-block']) }}
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>

@stop


@section('scripts')
 
{!! Html::script('js/select2.min.js') !!}

<script>

	$(document).ready(function() {
		$('.tag-multiple-select').select2();
	});

	$('.tag-multiple-select').select2().val({!! json_encode($post->tags()->allRelatedIds()) !!}).trigger('change');

</script>

@endsection	