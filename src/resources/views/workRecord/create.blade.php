@extends('layouts.auth')

@section('title', label('workRecord.create'))

@section('content')
    <h3><i class="glyphicon glyphicon-plus"></i> {{ label('workRecord.create') }}</h3>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post() !!}

                    {!! BootForm::select('作業内容', 'work')
                            ->options(['定植', '整枝', '交配', '収穫']) !!}

                    {!! BootForm::select('農薬名', '')
                            ->options(['アファーム', 'カスケード']) !!}

                    {!! BootForm::text('農薬使用倍率/使用量', '')->value(1000) !!}

                    {!! BootForm::text('作業日', 'datetime') !!}

                    {!! BootForm::textarea('備考', 'note')->rows(5) !!}

                    {!! BootForm::submit('追加', 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
                <!--/panel content-->
            </div>
            <!--/panel-->
        </div>
    </div>

@endsection