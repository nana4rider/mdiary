@extends('layouts.master')

@section('title', label('route.' . Route::currentRouteName()))

@section('header')
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ url() }}">{{ label('appName') }}</a>
    </div>
@endsection
