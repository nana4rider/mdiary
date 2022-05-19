@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ label('information') }}</h4>
                </div>
                <ul class="list-group">
                    @foreach($informations as $information)
                        <li class="list-group-item">
                            <a href="#" title="{{ $information->title }}"
                               data-dialog-message="{{ $information->message }}">
                                <i class="glyphicon glyphicon-info-sign"></i>
                                <small>{{ $information->datetime->format(config('format.date')) }}</small>
                                {{ $information->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
