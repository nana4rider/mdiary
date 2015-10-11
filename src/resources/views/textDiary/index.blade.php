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
                            <small>
                                Posted: {{ $textDiary->formatDatetime }}
                                @foreach($textDiary->textDiaryCategories as $category)
                                    |
                                    <a href="{{ url('textDiary') . '?' . http_build_query(['category' => $category->id]) }}">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </small>
                        </p>

                        <p>
                            {!! nl2br(e($textDiary->body)) !!}
                        </p>

                        <div class="row">
                            @foreach($textDiary->flickrs as $flickr)
                                <div class="col-md-3">
                                    <p>
                                        <a href="{{ $flickr->imageUrl }}" data-gallery title="{{ $textDiary->title }}"
                                           class="thumbnail">
                                            <img src="{{ $flickr->thumbnailUrl }}"
                                                 alt="{{ $textDiary->title }}">
                                        </a>
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        {!! BootForm::open()->get()->action(url('textDiary/' . $textDiary->id . '/edit'))->class('form-inline') !!}

                        {!! BootForm::submit(label('edit'), 'btn-primary') !!}

                        {!! BootForm::close() !!}
                    </div>
                </article>
            @endforeach

            <nav class="text-center">
                {!! $textDiaries->appends(['category' => Request::get('category')])->render() !!}
            </nav>
        </div>
    </div>

@endsection
