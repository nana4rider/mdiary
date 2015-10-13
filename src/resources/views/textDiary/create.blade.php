@extends('layouts.auth')

@section('title', label('textDiary.create'))

@section('content')
    <h1 class="page-header">@yield('title')</h1>

    @if(Session::has('newEntity'))
        <div data-dialog-onload class="hidden">
            <p>
                {{ message('complete', ['name' => 'post']) }}
            </p>

            {!! BootForm::open()->get() !!}

            {!! BootForm::submit(label('textDiary.index'))->formaction(route('textDiary.index')) !!}

            {!! BootForm::submit(label('edit'))->formaction(route('textDiary.edit', ['id' => Session::get('newEntity')->id])) !!}

            {!! BootForm::button(label('inputRepeat'), null, 'btn-primary')->data('dismiss', 'modal') !!}

            {!! BootForm::close() !!}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post()->action(route('textDiary.store'))->multipart() !!}

                    {!! BootForm::text(label('datetime'), 'datetime')->data('datetimepicker', 'datetime') !!}

                    {!! BootForm::text(label('title'), 'title') !!}

                    {!! BootForm::textarea(label('body'), 'body')->rows(config('const.text_diary_body_rows')) !!}

                    {!! BootForm::select(label('category'), 'categoryIds')
                            ->options($categoryOptions)->multiple() !!}

                    {!! BootForm::file(label('picture'), 'picture[]')->multiple() !!}

                    {!! BootForm::submit(label('post'), 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
