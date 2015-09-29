@extends('layouts.guest')

@section('title', label('login'))

@section('content')
    <div class="row sidebar">
        <div class="col-md-4 col-md-offset-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><i class="glyphicon glyphicon-lock"></i> {{ label('login') }}</h4>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <a href="{{ url('auth/google') }}" class="btn btn-block btn-social btn-google">
                        <span class="fa fa-google-plus"></span> {{ message('sign_in_with', ['name' => 'google']) }}
                    </a>
                    <a href="{{ url('auth/facebook') }}" class="btn btn-block btn-social btn-facebook">
                        <span class="fa fa-facebook"></span> {{ message('sign_in_with', ['name' => 'facebook']) }}
                    </a>
                </div>
                <!--/panel content-->
            </div>
            <!--/panel-->
        </div>
    </div>
@endsection
