<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/frontend_css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/price-range.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/passtrength.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/easyzoom.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/animate.css')}}" rel="stylesheet">
	<link href="{{ asset('css/frontend_css/main.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/responsive.css')}}" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/front_images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/front_images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/front_images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/front_images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
    
    @include('layouts.frontLayout.front_header')
	
    @yield('content')

    @include('layouts.frontLayout.front_footer')

    <script src="{{ asset('js/frontend-js/jquery.js')}}"></script>
	<script src="{{ asset('js/frontend-js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('js/frontend-js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{ asset('js/frontend-js/price-range.js')}}"></script>
    <script src="{{ asset('js/frontend-js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{ asset('js/frontend-js/easyzoom.js')}}"></script>
    <script src="{{ asset('js/frontend-js/main.js')}}"></script>
    <script src="{{ asset('js/frontend-js/jquery.validate.js')}}"></script>
    <script src="{{ asset('js/frontend-js/passtrength.js')}}"></script>
</body>
</html>