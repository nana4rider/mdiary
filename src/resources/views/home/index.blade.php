@extends('layouts.auth')

@section('title', label('home'))

@section('content')
    <h3><i class="glyphicon glyphicon-home"></i> {{ label('home') }}</h3>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ label('information') }}</h4>
                </div>
                <ul class="list-group information">
                    @foreach($informations as $information)
                        <li class="list-group-item">
                            <a href="#" class="show"
                               data-message="{{ $information->message }}">
                                <i class="glyphicon glyphicon-info-sign"></i>
                                <small>{{ $information->formatTime }}</small>
                                <span class="title">{{ $information->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ url('js/home.js') }}"></script>
@endsection
