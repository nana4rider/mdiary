@extends('layouts.guest')

@section('title', trans('labels.login'))

@section('content')
    <div class="row sidebar">
        <div class="col-sm-4 col-sm-offset-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>{{label('app_name')}}</h4>
                    </div>
                </div>
                <div class="panel-body">

                    <form action="{{url('/auth/login')}}" class="form form-vertical" data-method="post">
                        <div class="control-group{{$errors->has() ? " has-error" : ""}}">
                            <p class="text-danger">{{$errors->first()}}</p>

                            <label class="control-label" for="email">{{label('email')}}</label>

                            <div class="controls">
                                <input type="text" name="email" class="form-control" id="email"
                                       placeholder="{{message('input', ['name' => 'email'])}}"
                                       value="{{old('email')}}">
                            </div>

                            <label class="control-label" for="password">{{label('password')}}</label>

                            <div class="controls">
                                <input type="password" name="password" class="form-control" id="password"
                                       placeholder="{{message('input', ['name' => 'password'])}}">

                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="remember"></label>

                            <div class="controls">
                                <label class="inline">
                                    <input type="checkbox" name="remember" id="remember">
                                    {{message('remember_auth')}}
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label></label>

                            <div class="controls">
                                <button type="submit" class="btn btn-primary">
                                    {{label('login')}}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                <!--/panel content-->
            </div>
            <!--/panel-->
        </div>
    </div>
@endsection
