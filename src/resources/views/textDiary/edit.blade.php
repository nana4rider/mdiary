@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->put()->action(route('textDiary.update', ['id' => $textDiary->id]))->multipart() !!}

                    {!! BootForm::bind($textDiary) !!}

                    {!! BootForm::text(label('datetime'), 'datetimeText')->data('datetimepicker', 'datetime') !!}

                    {!! BootForm::text(label('title'), 'title') !!}

                    {!! BootForm::textarea(label('body'), 'body')->rows(config('const.text_diary_body_rows')) !!}
                    {!! BootForm::select(label('category'), 'categoryIds')
                            ->options($categoryOptions)->multiple() !!}

                    {!! BootForm::file(label('picture'), 'picture[]')->multiple()
                            ->helpBlock(count($textDiary->flickrs) === 0 ? '' : message('help.deletePicture')) !!}

                    <div class="row form-group" id="flickr-img">
                        @foreach($textDiary->flickrs as $flickr)
                            @if(!Session::hasOldInput('flickrIds') || in_array($flickr->id, Session::getOldInput('flickrIds')))
                                <div class="col-md-3">
                                    <a href="#" data-confirm="{{ message('deleteConfirm') }}" class="thumbnail">
                                        <img src="{{ $flickr->thumbnailUrl }}"
                                             alt="{{ $textDiary->title }}">
                                    </a>
                                    <input type="hidden" name="flickrIds[]" value="{{ $flickr->id }}">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {!! BootForm::submit(label('update'), 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('js/textDiary.js') }}"></script>
@endsection