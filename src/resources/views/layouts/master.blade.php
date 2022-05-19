<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>@yield('title') - {{ label('app_name') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('css/blueimp-gallery.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-image-gallery.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/common.css') }}">
    @yield('css')
    <link rel="icon" href="{{ url('img/favicon/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('img/favicon/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url('img/favicon/apple-touch-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('img/favicon/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('img/favicon/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('img/favicon/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('img/favicon/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url('img/favicon/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('img/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('img/favicon/apple-touch-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ url('img/favicon/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('img/favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ url('img/favicon/favicon-48x48.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url('img/favicon/favicon-96x96.png') }}">
</head>
<body class="no-thank-yu">

<header>
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            @yield('header')
        </div>
    </div>
</header>

<div class="container">
    @yield('content')
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center copyright">
                {{ label('copyright') }}
            </div>
        </div>
    </div>
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ url('js/jquery.browser.sp.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/jquery.blueimp-gallery.min.js') }}"></script>
<script src="{{ url('js/bootstrap-dialog.min.js') }}"></script>
<script src="{{ url('js/moment-with-locales.min.js') }}"></script>
<script src="{{ url('js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ url('js/bootstrap-select.min.js') }}"></script>
<script src="{{ url('js/bootstrap-select.ja.js') }}"></script>
<script src="{{ url('js/bootstrap-image-gallery.min.js') }}"></script>
<script src="{{ url('js/jquery.library.js') }}"></script>
<script src="{{ url('js/common.js') }}"></script>
@yield('js')
{{-- 各画面固有のjsファイル --}}
@if(File::exists(public_path('js/route/' . Route::currentRouteName()) . '.js'))
    <script src="{{ url('js/route/' . Route::currentRouteName() . '.js') }}"></script>
@endif
</body>
</html>
