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
            @include('layouts.menu', [
                'pattern' => 'home',
                'name' => 'home',
                'menu' => ['home']
            ])

            @include('layouts.menu', [
                'pattern' => 'textDiary*',
                'name' => 'textDiary',
                'menu' => ['textDiary.create', 'textDiary.index']
            ])

            @include('layouts.menu', [
                'pattern' => 'work*',
                'name' => 'work',
                'menu' => ['workDiary.create', 'workDiary.index', 'workRecord.create', 'workRecord.index']
            ])

            @include('layouts.menu', [
                'pattern' => 'aggregate*',
                'name' => 'aggregate',
                'menu' => ['aggregate.workField', 'aggregate.workDiary']
            ])
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