@extends('app')

@section('content')

    <div class="center-block" style="max-width: 50%">
    <h1>Login</h1>

    @include('errors.partials.list')

    {!! Form::open(['route' => 'auth.login', 'method' => 'post']) !!}

    <div class="form-group">
        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>
@stop
