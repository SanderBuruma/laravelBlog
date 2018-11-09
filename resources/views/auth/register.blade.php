@extends('main')

@section('title', '| Register')

@section('content')


<div class="row">
		<div class="col-md-6 offset-md-3">
			{{ Form::open() }}

				{{Form::label('name', 'Name:')}}
				{{Form::text('name', null, ['class' => 'form-control'])}}

				{{Form::label('email', 'E-Mail:')}}
				{{Form::email('email', null, ['class' => 'form-control'])}}

				{{Form::label('password', 'Password:')}}
				{{Form::password('password', ['class' => 'form-control'])}}

				{{Form::label('password_confirmation', 'Confirm Password:')}}
				{{Form::password('password_confirmation', ['class' => 'form-control'])}}
				<br>
				{{Form::submit('Register', ['class'=>'btn btn-primary btn-block'])}}

			{{ Form::close() }}
		</div>
	</div>

@stop