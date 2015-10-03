@extends('layouts.master')

@section('header')
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse,.sidebar">
            <span class="glyphicon glyphicon-align-justify"></span>
        </button>
        <a class="navbar-brand" href="{{ url() }}">{{ label('app_name') }}</a>

    </div>
    <div class="navbar-collapse collapse navbar-collapse2">
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
                    <i class="glyphicon glyphicon-user"></i> {{ $currentUser->name }} <span class="caret"></span></a>
                <ul id="g-account-menu" class="dropdown-menu" role="menu">
                    <li><a href="{{ url('auth/logout') }}">
                            <i class="glyphicon glyphicon-lock"></i> {{ label('logout') }}</a></li>
                </ul>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        {{-- メニュー --}}
        <nav class="col-sm-3 sidebar">
            <hr>
            <ul class="nav nav-stacked">
                <li>
                    <a href="{{ url('home') }}"><i class="glyphicon glyphicon-home"></i> {{ label('home') }}</a>
                </li>
            </ul>

            <hr>
            <h4>日記</h4>
            <ul class="nav nav-stacked">
                <li>
                    <a href="{{ url('textDiary/create') }}">
                        <i class="glyphicon glyphicon-pencil"></i> {{ label('textDiary.create') }}</a>
                </li>
                <li>
                    <a href="{{ url('textDiary') }}">
                        <i class="glyphicon glyphicon-book"></i> {{ label('textDiary.index') }}</a>
                </li>
            </ul>

            <hr>

            <h4>作業</h4>
            <ul class="nav nav-stacked">
                <li>
                    <a href="{{ url('workDiary/create') }}">
                        <i class="glyphicon glyphicon-plus"></i> {{ label('workDiary.create') }}</a>
                </li>
                <li>
                    <a href="{{ url('workDiary') }}">
                        <i class="glyphicon glyphicon-book"></i> {{ label('workDiary.index') }}</a>
                </li>
                <li>
                    <a href="{{ url('workRecord/create') }}">
                        <i class="glyphicon glyphicon-plus"></i> {{ label('workRecord.create') }}</a>
                </li>
                <li>
                    <a href="{{ url('workRecord') }}">
                        <i class="glyphicon glyphicon-book"></i> {{ label('workRecord.index') }}</a>
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
