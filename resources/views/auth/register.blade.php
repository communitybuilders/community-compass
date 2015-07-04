@extends('app')

@section('content')

    <div class="center-block" style="max-width: 50%">
    <h1>Sign Up</h1>

    @include('errors.partials.list')

    {!! Form::open(['route' => 'auth.register', 'method' => 'post']) !!}

    <div class="form-group">
        {!! Form::label('username', 'Username', ['class' => 'control-label']) !!}
        {!! Form::text('username', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('first_name', 'First Name', ['class' => 'control-label']) !!}
        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('last_name', 'Last name', ['class' => 'control-label']) !!}
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirm password', ['class' => 'control-label']) !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Register', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>

@stop
