<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Community Compass</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- TODO: move style into assets and combine/minify with gulpfile.js -->
    <style>
        body {
            padding-top: 50px;
        }
        .starter-template {
            padding: 40px 15px;
            text-align: center;
        }
        #autocomplete {
            margin-top: 1em;
        }
    </style>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('pages.index') }}">Community Compass</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
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

<script>

    $(function () {
        var current_row = 30;

        $(window).scroll(function() {

            setTimeout(function(){
                if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
                    $.ajax({
                        type: "POST",
                        url: "organisations/ajaxloadorganisations",
                        data: {
                            '_token':$('input[name=_token]').val(),
                            'current_row':current_row
                        },

                        success: function(data) {
                            current_row = current_row + current_row;
                            var display;
                            var result = JSON.parse(data);

                            $(result).each(function(index, value){
                                display += "<section class='col-xs-6 col-md3 col-md-3 col-lg-3'>";
                                display +="<div class='panel panel-default' style='padding: 10px 10px 10px 10px;'>";
                                display +="<img src='http://www.clipartbest.com/cliparts/9Tp/bX4/9TpbX4njc.png' alt='image' width='140'><br />";
                                display += value.legal_name + "<br />";
                                display +="<a>claim</a><br /><a>like</a> <br /><a>subscribe</a><br /><a>donate</a><br /></div></section>";

                            });

                            $(".organisations_div").append(display);
                        }
                    });

                }
            }, 200);
        });

        $(document).on("click", ".claim", function () {
            var claim_id = $(this).data('id');
            $(".modal-body #bookId").val( claim_id );
            $('#addBookDialog').modal('show');
        });

    });


</script>
<script src="/js/all.js"></script>
</body>
</html>