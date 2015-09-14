@extends('layouts.master')

@section('header')
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-toggle"></span>
        </button>
        <a class="navbar-brand" href="{{url()}}">{{trans('labels.app_name')}}</a>
    </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
                    <i class="glyphicon glyphicon-user"></i> {{Auth::user()->name}} <span
                            class="caret"></span></a>
                <ul id="g-account-menu" class="dropdown-menu" role="menu">
                    <li><a href="{{url('/auth/logout')}}"><i
                                    class="glyphicon glyphicon-lock"></i> {{trans('labels.logout')}}</a></li>
                </ul>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        {{-- メニュー --}}
        <nav class="col-sm-3 sidebar">
            <h3><i class="glyphicon glyphicon-menu-hamburger"></i> {{trans('labels.menu')}}</h3>
            <hr>
            <ul class="nav nav-stacked">
                <li class="active">
                    <a href="{{url('/home')}}"><i class="glyphicon glyphicon-home"></i> {{trans('labels.home')}}</a>
                </li>
            </ul>

            <hr>
            <h4>日記</h4>
            <ul class="nav nav-stacked">
                <li class="active">
                    <a href="#"><i class="glyphicon glyphicon-pencil"></i> 日記を書く</a>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i> 日記を見る</a>
                </li>
            </ul>

            <hr>

            <ul class="nav nav-stacked">
                <h4>集計</h4>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-book"></i> 月次集計</a>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-book"></i> 年次集計</a>
                </li>
            </ul>
            <hr>
        </nav>

        {{-- メインコンテンツ --}}
        <div class="col-sm-9 main">
            @yield('content')
        </div>
    </div>
@overwrite