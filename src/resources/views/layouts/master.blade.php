<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>@yield('title') - {{trans('labels.app_name')}}</title>
    <meta name="generator" content="Bootply"/>
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

<footer class="text-center">Copyright &copy; 2015 Shunichiro Aki</footer>

<div class="modal" id="addWidgetModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Widget</h4>
            </div>
            <div class="modal-body">
                <p>Add a widget stuff here..</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn">Close</a>
                <a href="#" class="btn btn-primary">Save changes</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dalog -->
</div>
<!-- /.modal -->

<!-- script references -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
@yield('js')
</body>
</html>