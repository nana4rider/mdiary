@extends('layouts.auth')

@section('title', label('textDiary.create'))

@section('content')
    <h3><i class="glyphicon glyphicon-pencil"></i> {{ label('textDiary.create') }}</h3>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post() !!}

                    {!! BootForm::text('日時', 'datetime')->data('datetimepicker', 'datetime') !!}

                    {!! BootForm::text('タイトル', 'title') !!}

                    {!! BootForm::textarea('本文', 'note')->rows(10) !!}

                    {!! BootForm::select('カテゴリ', 'category')
                            ->options(['ちょびん', 'にゃんた', 'こみけたん'])->multiple() !!}

                    {!! BootForm::file('写真', 'picture')->multiple() !!}

                    {!! BootForm::submit('投稿', 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
                <!--/panel content-->
            </div>
            <!--/panel-->
        </div>
    </div>

@endsection
