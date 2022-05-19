@extends('layouts.guest')

@section('title', label('route.login'))

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="page-header">@yield('title')</h1>

            <p>
                <a href="{{ route('social.authorize', ['provider' => 'google']) }}" class="btn btn-social btn-google">
                    <span class="fa fa-google-plus"></span> {{ message('sign_in_with', ['name' => 'google']) }}
                </a>
            </p>

            <p>
                <a href="{{ route('social.authorize', ['provider' => 'facebook']) }}"
                   class="btn btn-social btn-facebook">
                    <span class="fa fa-facebook"></span> {{ message('sign_in_with', ['name' => 'facebook']) }}
                </a>
            </p>

            <p>
                <a href="{{ route('social.authorize', ['provider' => 'github']) }}"
                   class="btn btn-social btn-github">
                    <span class="fa fa-github"></span> {{ message('sign_in_with', ['name' => 'github']) }}
                </a>
            </p>
        </div>
    </div>
@endsection
