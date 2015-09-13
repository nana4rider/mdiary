@extends('layouts.guest')

@section('title', trans('labels.login'))

@section('content')
    <div class="row sidebar">
        <div class="col-sm-4 col-sm-offset-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>{{trans('labels.app_name')}}</h4>
                    </div>
                </div>
                <div class="panel-body">

                    <form method="POST" action="{{url('/auth/login')}}" class="form form-vertical">
                        {!! csrf_field() !!}


                        <div class="control-group{{$errors->has() ? " has-error" : ""}}">
                            <p class="text-danger">{{$errors->first()}}</p>

                            <label class="control-label">{{trans('labels.email')}}</label>

                            <div class="controls">
                                <input type="text" name="email" class="form-control"
                                       placeholder="{{trans("messages.input", ['name' => trans('labels.email')])}}"
                                       value="{{ old('email') }}">
                            </div>

                            <label class="control-label">{{trans('labels.password')}}</label>

                            <div class="controls">
                                <input type="password" name="password" class="form-control"
                                       placeholder="{{trans("messages.input", ['name' => trans('labels.password')])}}">

                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="rememberme"></label>

                            <div class="controls">
                                <label class="inline">
                                    <input type="checkbox" name="remember">
                                    {{trans('messages.remember_auth')}}
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label></label>

                            <div class="controls">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('labels.login')}}
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