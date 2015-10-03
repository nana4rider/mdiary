@extends('layouts.auth')

@section('title', label('workRecord.create'))

@section('content')
    <h1 class="page-header">@yield('title')</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post() !!}

                    {!! BootForm::text('日時', 'datetime')->data('datetimepicker', 'datetime') !!}

                    {!! BootForm::select('作物', 'product')->options(['スイカ', 'ほうれん草', '小松菜']) !!}

                    {!! BootForm::select('場所', 'place')
                            ->options(['A1', 'A2', 'A3'])->multiple()
                            ->helpBlock('選択できない場所は、以前の作業日誌をアーカイブした後に選択できます。') !!}

                    {!! BootForm::select('作業内容', 'work')
                            ->options(['防除', '定植', '整枝', '交配', '収穫']) !!}

                    {!! BootForm::select('農薬名', '')
                            ->options(['アファーム', 'カスケード']) !!}

                    {!! BootForm::text('農薬使用倍率/使用量', '')->value(1000) !!}

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