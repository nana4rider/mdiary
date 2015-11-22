@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-9">
            {{-- 日記 --}}
            @foreach($textDiaries as $textDiary)
                <article class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">{{ $textDiary->title }}</h4>
                    </div>
                    <div class="panel-body">
                        <p>
                            <small>
                                {{ label('posted') }}: {{ $textDiary->datetime->format(config('format.datetime')) }} |
                                @foreach($textDiary->textDiaryCategories as $category)
                                    <a href="{{ route('textDiary.index') . '?' .
                                                http_build_query(['category' => $category->id]) }}"
                                       class="no-underline">
                                        <span class="label label-primary">{{ $category->name }}</span>
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

                        {!! BootForm::open()->delete()->action(route('textDiary.destroy', ['id' => $textDiary->id]))
                                ->class('form-inline') !!}

                        <a href="{{ route('textDiary.edit', ['id' => $textDiary->id]) }}"
                           class="btn btn-primary btn-sm">{{ label('edit') }}</a>

                        {!! BootForm::submit(label('destroy'), 'btn-danger btn-sm')
                                ->data('confirm', message('confirm.delete'))
                                ->data('dialog-type', 'danger') !!}

                        {!! BootForm::close() !!}
                    </div>
                </article>
            @endforeach

            <nav class="text-center">
                {!! $textDiaries->appends(['category' => Request::get('category')])->render() !!}
            </nav>
        </div>

        <div class="col-md-3">
            {{-- カテゴリ一覧 --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        {{ label('category') }}
                    </h4>
                </div>
                <div class="list-group">
                    <a class="list-group-item{{ !Request::has('category') ? ' active' : '' }}"
                       href="{{ route('textDiary.index') }}">
                        {{ label('all') }}
                    </a>
                    @foreach($categories as $category)
                        <a class="list-group-item{{ Request::get('category') == $category->id ? ' active' : '' }}"
                           href="{{ route('textDiary.index') . '?' .
                                    http_build_query(['category' => $category->id]) }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
