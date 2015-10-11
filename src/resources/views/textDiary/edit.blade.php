@extends('layouts.auth')

@section('title', label('textDiary.edit'))

@section('content')
    <h1 class="page-header">@yield('title')</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->put()->action(url('textDiary/' . $textDiary->id))->multipart() !!}

                    {!! BootForm::text(label('datetime'), 'datetime')->data('datetimepicker', 'datetime')->value($textDiary->formatDatetime) !!}

                    {!! BootForm::text(label('title'), 'title')->value($textDiary->title) !!}

                    {!! BootForm::textarea(label('body'), 'body')->rows(10)->value($textDiary->body) !!}
                    {!! BootForm::select(label('category'), 'category')
                            ->options($categoryOptions)->multiple()->select($textDiary->categoryIds) !!}

                    {!! BootForm::file(label('picture'), 'picture[]')->multiple()
                            ->helpBlock(count($textDiary->flickrs) === 0 ? '' : message('help.deletePicture')) !!}

                    <div class="row form-group" id="flickr-img">
                        @foreach($textDiary->flickrs as $flickr)
                            <div class="col-md-3">
                                <a href="#" data-confirm="{{ message('deleteConfirm') }}" class="thumbnail">
                                    <img src="{{ $flickr->thumbnailUrl }}"
                                         alt="{{ $textDiary->title }}">
                                </a>
                                <input type="hidden" name="flickrId" value="{{ $flickr->id }}">
                            </div>
                        @endforeach
                    </div>

                    {!! BootForm::submit(label('update'), 'btn-primary') !!}

                    {!! BootForm::submit(label('delete'), 'btn-danger')->data('method', 'delete')->data('confirm', message('deleteConfirm')) !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ url('js/textDiary.js') }}"></script>
@endsection