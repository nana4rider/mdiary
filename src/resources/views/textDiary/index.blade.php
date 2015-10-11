@extends('layouts.auth')

@section('title', label('textDiary.index'))

@section('content')
    <h1 class="page-header">@yield('title')</h1>

    <div class="row">
        <div class="col-md-12">
            {{-- カテゴリ一覧 --}}
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#diaryCategory" data-toggle="collapse">
                                {{ label('category') }}<span class="glyphicon glyphicon-chevron-up pull-right"></span>
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="diaryCategory">
                        <div class="list-group">
                            @foreach($categories as $category)
                                <a class="list-group-item{{ Request::get('category') == $category->id ? ' active' : '' }}"
                                   href="{{ url('textDiary') . '?' . http_build_query(['category' => $category->id]) }}">
                                    {{ $category->name }}
                                    <span class="badge">{{ $dairyCount[$category->id] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- 日記 --}}
            @foreach($textDiaries as $textDiary)
                <article class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">{{ $textDiary->title }}</h4>
                    </div>
                    <div class="panel-body">
                        <p>
                            <small>Posted: {{ $textDiary->datetime->format(config('format.datetime')) }} |</small>
                            @foreach($textDiary->textDiaryCategories as $category)
                                <span class="label label-primary">{{ $category->name }}</span>
                            @endforeach
                        </p>

                        <p>
                            {!! nl2br(e($textDiary->body)) !!}
                        </p>

                        @foreach($textDiary->flickrs as $flickr)
                            <div class="col-md-4">
                                <p>
                                    <a href="{{ $flickr->id }}" data-gallery title="{{ $textDiary->title }}">
                                        <img src="{{ $flickr->id }}"
                                             alt="{{ $textDiary->title }}" class="img-thumbnail">
                                    </a>
                                </p>
                            </div>
                        @endforeach

                        <div class="col-md-12">
                            {!! BootForm::open()->get()->action(url('textDiary/1/edit')) !!}

                            {!! BootForm::submit('編集', 'btn-primary') !!}

                            {!! BootForm::close() !!}
                        </div>
                    </div>
                </article>
            @endforeach

            <nav class="text-center">
                <ul class="pagination">
                    <li class="disabled"><span>«</span></li>
                    <li class="active"><span>1</span></li>
                    <li><a href="?page=2">2</a></li>
                    <li><a href="?page=3">3</a></li>
                    <li><a href="?page=4">4</a></li>
                    <li><a href="?page=5">5</a></li>
                    <li><a href="?page=6">6</a></li>
                    <li><a href="?page=7">7</a></li>
                    <li><a href="?page=8">8</a></li>
                    <li class="disabled"><span>...</span></li>
                    <li><a href="?page=13">13</a></li>
                    <li><a href="?page=14">14</a></li>
                    <li><a href="?page=2" rel="next">»</a></li>
                </ul>
            </nav>
        </div>
    </div>

@endsection
