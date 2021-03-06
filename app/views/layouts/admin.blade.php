<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title', 'POFAC')</title>

    <!-- Bootstrap core CSS -->

    {{ HTML::style('assets/js/modulos/bootstrap/css/bootstrap.min.css', array('media' => 'screen')) }}

    <!-- Custom styles for this template -->
    {{HTML::style("assets/css/admin/global.css")}}

    @if(isset($css_array))
        @foreach($css_array as $var)
            {{ HTML::style($var, array('media' => 'screen')) }}
        @endforeach;
    @endif

    @if(isset($css_print_array))
        @foreach($css_print_array as $var)
            {{ HTML::style($var, array('media' => 'print')) }}
        @endforeach;
        @endif

                <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]>
        <!--<script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>

<div class="container">

    <!-- Static navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/poanes/public/">Seguridad Vecinal</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse pull-right">
                <ul class="nav navbar-nav">
                    <li styles="white"><a href="#">Hola, Pepe</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
    <br><br><br>

    @if (Session::has('message'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success bootstrap-admin-alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <h4>¡Alerta!</h4>
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
    @endif

    @yield('content')

    <div class="navbar navbar-default navbar-fixed-bottom" style="margin-bottom: 0px">
        <div class="container">
            <p class="navbar-text pull-left">© 2015 -
                <a href="#" target="_blank">Seguridad Vecinal</a>
            </p>
        </div>
    </div>
</div>
<!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
{{ HTML::script('assets/js/modulos/bootstrap/js/bootstrap.min.js') }}


@if(isset($js_array))
    @foreach($js_array as $var)
        {{ HTML::script($var) }}
    @endforeach;
@endif

</body>
</html>
