<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Community Compass</title>

    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="{{ str_replace('.', '-', Route::currentRouteName()) }}">

<nav class="navbar navbar-inverse navbar-fixed-top" style="max-height:30px;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{ route('pages.index') }}" >
                <img style="vertical-align: top; max-width:50px; margin-top: -15px; display:inline-block;" src="/images/logo.png"/>Community Compass
            </a>
            @if (Route::currentRouteName() === 'organisations.index')
                <div class="form-group">
                    <input type="text" name="autocomplete" id="autocomplete" class="form-control" style="max-width:700px; width:50%; margin-top: 8px;" value="" title="" required="required" >
                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="lat" id="lng">
                </div>
            @endif

        </div>
        <div id="navbar" class="collapse navbar-inverse" style="width:200px; margin-top:0px; float:right; padding-left:30px">
            <ul class="nav navbar-nav">
                <li><a href="/organisations">Organisation</a></li>
            </ul>

            <!-- TODO: change links depending on logged in or guest user -->
            <ul class="nav navbar-nav navbar-right">
                @include('partials.navbar.' . $guestOrUser)
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    @yield('content')

</div><!-- /.container -->

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="/js/all.js"></script>

</body>
</html>