@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->put()->action(route('textDiary.update', ['id' => $textDiary->id]))->multipart() !!}

                    {!! BootForm::bind($textDiary) !!}

                    {!! BootForm::text(label('datetime'), 'datetime_input')->type('datetime-local') !!}

                    {!! BootForm::text(label('title'), 'title') !!}

                    {!! BootForm::textarea(label('body'), 'body')->rows(config('const.text_diary_body_rows')) !!}
                    {!! BootForm::select(label('category'), 'category_ids')
                            ->options($categories->lists('name', 'id'))->multiple() !!}

                    {!! BootForm::file(label('picture'), 'picture[]')->multiple()
                            ->helpBlock(count($textDiary->flickrs) === 0 ? '' : message('help.text_diary_edit.picture')) !!}

                    <div class="row form-group" id="flickr-img">
                        @foreach($textDiary->flickrs as $flickr)
                            @if(!Session::hasOldInput('flickr_ids') || in_array($flickr->id, Session::getOldInput('flickr_ids')))
                                <div class="col-md-3">
                                    <a href="#" data-confirm="{{ message('confirm.delete') }}" class="thumbnail">
                                        <img src="{{ $flickr->thumbnail_url }}"
                                             alt="{{ $textDiary->title }}">
                                    </a>
                                    <input type="hidden" name="flickr_ids[]" value="{{ $flickr->id }}">
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
