@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post()->action(route('textDiary.store'))->multipart() !!}

                    {!! BootForm::text(label('datetime'), 'datetime_input')->type('datetime-local') !!}

                    {!! BootForm::text(label('title'), 'title') !!}

                    {!! BootForm::textarea(label('body'), 'body')->rows(config('const.text_diary_body_rows')) !!}

                    {!! BootForm::select(label('category'), 'category_ids')
                            ->options($categories->lists('name', 'id'))->multiple() !!}

                    {!! BootForm::file(label('picture'), 'picture[]')->multiple() !!}

                    {!! BootForm::submit(label('post'), 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
