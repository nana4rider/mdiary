@extends('layouts.master')

@section('header')
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ url() }}">{{ label('app_name') }}</a>
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse" id="navbar-main">
        <ul class="nav navbar-nav">
            <li class="{{ Request::is('home') ? 'active' : null }}">
                <a href="{{ url('home') }}">{{ label('home') }}</a>
            </li>
            <li class="dropdown {{ Request::is('textDiary*') ? 'active' : null }}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ label('textDiary') }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('textDiary/create') }}">{{ label('textDiary.create') }}</a></li>
                    <li><a href="{{ url('textDiary') }}">{{ label('textDiary.index') }}</a></li>
                </ul>
            </li>

            <li class="dropdown {{ Request::is('work*') ? 'active' : null }}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ label('work') }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('workDiary/create') }}">{{ label('workDiary.create') }}</a></li>
                    <li><a href="{{ url('workDiary') }}">{{ label('workDiary.index') }}</a></li>
                    <li><a href="{{ url('workRecord/create') }}">{{ label('workRecord.create') }}</a></li>
                    <li><a href="{{ url('workRecord') }}">{{ label('workRecord.index') }}</a></li>
                </ul>
            </li>

        </ul>
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
