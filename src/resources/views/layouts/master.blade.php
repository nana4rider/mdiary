<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>@yield('title') - {{label('app_name')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="{{url('/css/dashboard.styles.css')}}" rel="stylesheet">
    @yield('css')
</head>
<body>

<!-- Header -->
<header id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        @yield('header')
    </div>
    <!-- /container -->
</header>
<!-- /Header -->

<!-- Main -->
<div class="container">
    @yield('content')
</div>
<!-- /Main -->

<footer class="text-center">
    Copyright <span class="glyphicon glyphicon-copyright-mark"></span>
    2015 Shunichiro Aki.
</footer>

<!-- script references -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="{{url('/js/bootstrap-dialog.js')}}"></script>
<script src="{{url('/js/common.js')}}"></script>
@yield('js')
</body>
</html>
