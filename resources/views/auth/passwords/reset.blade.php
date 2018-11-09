@extends('main')

@section('title', '| Reset Password')

@section('content')

<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-default">
            <div class="card-header">
                Reset Password
            </div>
            <div class="card-body">
                {!! Form::open(['url'=>'password/reset', 'method'=>"POST"]) !!}

                {!! Form::hidden('token', $token) !!}

                {!! Form::label('email', 'Email Address') !!}
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                <br>

                {!! Form::label('password', 'New Password:') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
                {!! Form::label('password_confirmation', 'Password Confirm:') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                <br>
                
                {!! Form::submit('Reset Password', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
