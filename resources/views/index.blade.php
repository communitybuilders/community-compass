@extends('app')

@section('content')
    <h1>{{ Auth::guest() ? 'GUEST' : 'LOGGED IN' }}</h1>
@stop