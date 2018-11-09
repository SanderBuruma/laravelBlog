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
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status')}}
                    </div>
                @endif
                {!! Form::open(['url'=>'password/email', 'method'=>"POST"]) !!}

                {!! Form::label('email', 'Email Address') !!}
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                <br>
                {!! Form::submit('Reset Password', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
