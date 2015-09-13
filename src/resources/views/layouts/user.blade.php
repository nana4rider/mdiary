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
                    <i class="glyphicon glyphicon-user"></i> {{Auth::user()->login_name}} <span
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


        <div class="col-sm-3 sidebar">
            <h3><i class="glyphicon glyphicon glyphicon-home"></i> <a href="{{url('/home')}}">ホーム</a></h3>
            <hr>
            <h3><i class="glyphicon glyphicon-menu-hamburger"></i> 日記</h3>
            <hr>
            <ul class="nav nav-stacked">
                <li class="active">
                    <a href="#"><i class="glyphicon glyphicon-pencil"></i> 日記を書く</a>
                </li>
                <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> 日記を見る</a></li>
            </ul>
            <hr>

            <h3><i class="glyphicon glyphicon-menu-hamburger"></i> 集計</h3>
            <hr>
            <ul class="nav nav-stacked">
                <li class="active">
                    <a href="#"><i class="glyphicon glyphicon-book"></i> 月次集計</a>
                </li>
                <li><a href="#"><i class="glyphicon glyphicon-book"></i> 年次集計</a></li>
            </ul>
            <hr>

        </div>

        {{-- メインコンテンツ --}}
        <div class="col-sm-9 col-sm-offset-3 main">
            @yield('content')
        </div>
    </div>
@overwrite
