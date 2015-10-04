@extends('layouts.auth')

@section('title', label('workDiary.create'))

@section('content')
    <h1 class="page-header">@yield('title')</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post()->action(url('workDiary')) !!}

                    {!! BootForm::select('作物', 'product')->options(['スイカ', 'ほうれん草', '小松菜']) !!}

                    {!! BootForm::select('場所', 'place')
                            ->options(['A1', 'A2', 'A3'])->multiple()
                            ->helpBlock('選択できない場所は、以前の作業日誌をアーカイブした後に選択できます。') !!}

                    {!! BootForm::textarea('備考', 'note')->rows(5) !!}

                    {!! BootForm::submit('作成', 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
                <!--/panel content-->
            </div>
            <!--/panel-->
        </div>
    </div>

@endsection
