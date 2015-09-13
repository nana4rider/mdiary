@extends('layouts.user')

@section('title', 'Welcome')

@section('content')
    <h3><i class="glyphicon glyphicon-home"></i> {{trans('labels.home')}}</h3>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('labels.information')}}
                </div>
                <ul class="list-group information">
                    <li class="list-group-item list-group-item-info">
                        <a href="#" class="show"
                           data-message="使用言語:PHP5.6
フレームワーク:Laravel5.1&#10;データベース:MySQL&#10;CSS:Bootstrap3">
                            <i class="glyphicon glyphicon-info-sign"></i>
                            <small>2015/09/12</small>
                            <span class="title">開発環境について</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="show" data-message="開発開始しました">
                            <i class="glyphicon glyphicon-info-sign"></i>
                            <small>2015/09/11</small>
                            <span class="title">開発開始</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{url('/js/home.js')}}"></script>
@endsection