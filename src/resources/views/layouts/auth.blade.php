@extends('layouts.master')

@section('title', label('route.' . snake_case(Route::currentRouteName())))

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
                <a href="{{ route('home') }}">{{ label('route.home') }}</a>
            </li>

            <li class="dropdown {{ Request::is('textDiary*') ? 'active' : null }}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ label('menu.text_diary') }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('textDiary.create') }}">{{ label('route.text_diary.create') }}</a></li>
                    <li><a href="{{ route('textDiary.index') }}">{{ label('route.text_diary.index') }}</a></li>
                </ul>
            </li>

            <li class="dropdown {{ Request::is('work*') ? 'active' : null }}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ label('menu.work') }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('workDiary.create') }}">{{ label('route.work_diary.create') }}</a></li>
                    <li><a href="{{ route('workDiary.index') }}">{{ label('route.work_diary.index') }}</a></li>
                    <li><a href="{{ route('workRecord.create') }}">{{ label('route.work_record.create') }}</a></li>
                    <li><a href="{{ route('workRecord.index') }}">{{ label('route.work_record.index') }}</a></li>
                </ul>
            </li>

            <li class="dropdown {{ Request::is('aggregate*') ? 'active' : null }}">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ label('menu.aggregate') }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('aggregate.workField') }}">{{ label('route.aggregate.work_field') }}</a></li>
                    <li><a href="{{ route('aggregate.workDiary') }}">{{ label('route.aggregate.work_diary') }}</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
                    <i class="glyphicon glyphicon-user"></i>
                    {{ $currentUser->name . '@' . $currentUser->group->name }}
                    <span class="caret"></span></a>
                <ul id="g-account-menu" class="dropdown-menu" role="menu">
                    <li><a href="{{ route('logout') }}">
                            <i class="glyphicon glyphicon-lock"></i> {{ label('route.logout') }}</a></li>
                </ul>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    @if(Session::has('complete'))
        <div data-dialog-onload class="hidden">
            <p>
                {{ message('complete', ['name' => Session::get('complete')]) }}
            </p>
        </div>
    @endif

    <h1 class="page-header">@yield('title')</h1>

    @yield('content')
@overwrite