@extends('app')

@section('content')
    <div class="form-group">
        <input type="text" name="autocomplete" id="autocomplete" class="form-control" value="" title="" required="required" >
        <input type="hidden" name="lat" id="lat">
        <input type="hidden" name="lat" id="lng">
    </div>

    <div id="canvas"></div>

@stop