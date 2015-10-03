<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>@yield('title') - {{ label('app_name') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('css/dashboard.styles.css') }}">
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-social/4.10.1/bootstrap-social.min.css">
    <link rel="stylesheet" href="{{ url('css/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-image-gallery.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/common.css') }}">
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

<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title">Title</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal Title</h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- script references -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.6/js/bootstrap-dialog.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{ url('js/bootstrap-multiselect.js') }}"></script>
<script src="{{ url('js/bootstrap-image-gallery.min.js') }}"></script>
<script src="{{ url('js/common.js') }}"></script>
@yield('js')
</body>
</html>
