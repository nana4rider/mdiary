@extends('layouts.auth')

@section('title', label('home'))

@section('content')
    <h1 class="page-header">{{ label('information') }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <ul class="list-group">
                    @foreach($informations as $information)
                        <li class="list-group-item">
                            <a href="#" data-information="{{ $information->toJson() }}">
                                <i class="glyphicon glyphicon-info-sign"></i>
                                <small>{{ $information->formatTime }}</small>
                                {{ $information->title }}
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
