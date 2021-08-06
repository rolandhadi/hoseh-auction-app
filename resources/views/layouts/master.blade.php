<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=0,initial-scale=1.0, maximum-scale=1, minimum-scale=1"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ url('favicon.ico') }}">
    <link rel="shortcut icon" href="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>hoseh.sg</title>


    <!-- Custom styles for this template -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/font.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/font-custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/overwrite-bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/color-switch.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/jquery.simple-dtpicker.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/pricing.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/bootstrap-dialog.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/kenji.css') }}" rel="stylesheet" type="text/css"/>
    <!-- <link href="#green" id="color" rel="stylesheet" type="text/css" /> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/color-switch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.ui.touch-punch.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/holder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.dotdotdot.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.elevateZoom.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.zoom.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('js/bootstrap-tagsinput-angular.js') }}"></script> -->
    <script type="text/javascript" src="{{ asset('js/jquery-birthday-picker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.simple-dtpicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-dialog.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

</head>

<body>
<div class="wrapper">

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

</div>
</body>
</html>
