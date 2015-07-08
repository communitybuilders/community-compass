@extends('app')

@section('content')
    <div class="row">
        <div class="col-xs-11">
            <div class="form-group">
                <input type="text" name="autocomplete" id="autocomplete" class="form-control" value="" title="" required="required" >
                <input type="hidden" name="lat" id="lat">
                <input type="hidden" name="lat" id="lng">
            </div>
        </div>

        <div class="col-xs-1">
            <div id="categories-filter" class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Filter
                    <span class="caret"></span>
                </button>
                @if ($categories)
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a class="category-0">All categories</a></li>
                        @foreach ($categories as $category)
                            <li><a class="category-{{ $category->id }}">{{ $category->category }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div id="canvas"></div>

@stop
