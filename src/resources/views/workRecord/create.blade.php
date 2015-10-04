@extends('layouts.auth')

@section('title', label('workRecord.create'))

@section('content')
    <h1 class="page-header">@yield('title')</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post()->action(url('workRecord')) !!}

                    {!! BootForm::text('作業日時', 'datetime')->data('datetimepicker', 'datetime') !!}

                    {!! BootForm::select('作物', 'product')->options(['スイカ', 'ほうれん草', '小松菜']) !!}
                    {!! BootForm::select('場所', 'place')
                            ->options(['A1', 'A2', 'A3'])->multiple()
                            ->helpBlock('選択できない場所は、以前の作業日誌をアーカイブした後に選択できます。') !!}

                    {!! BootForm::select('作業内容', 'work')
                            ->options(['防除', '定植', '整枝', '交配', '収穫']) !!}

                    {!! BootForm::textarea('備考', 'note')->rows(5) !!}

                    <div class="form-group">
                        <label class="control-label">農薬</label>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>農薬名</th>
                                <th>
                                    農薬使用倍率/使用量
                                    <span class="pull-right">
                                        <a href="#" id="pesticide-add" title="農薬を追加">
                                            <span class="glyphicon glyphicon-plus"></span></a>
                                    </span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>アファーム</td>
                                <td>
                                    1000
                                    <span class="pull-right">
                                        <a href="#" id="pesticide-remove" title="農薬を削除">
                                            <span class="glyphicon glyphicon-remove"></span></a>
                                    </span>
                                </td>
                            </tr>

                            </tbody>
                        </table>

                    </div>

                    {!! BootForm::submit('作成', 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="pesticide-form" class="hidden">
        {!! BootForm::open()->post()->action(url('workRecord/xxx')) !!}

        {!! BootForm::select('農薬名', '')
                ->options(['未選択', 'アファーム', 'カスケード']) !!}

        {!! BootForm::text('農薬使用倍率/使用量', '')->value(1000) !!}

        {!! BootForm::submit('追加', 'btn-primary') !!}

        {!! BootForm::close() !!}
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('#pesticide-add').on('click', function (e) {
                var $this = $(this);
                e.preventDefault();

                BootstrapDialog.show({
                    title: $this.data('original-title'),
                    message: function (dialog) {
                        return $('#pesticide-form').clone().removeClass('hidden');
                    }
                });
            });
        });
    </script>
@endsection