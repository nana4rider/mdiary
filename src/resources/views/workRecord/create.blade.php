@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post()->action(route('workRecord.store')) !!}

                    {!! BootForm::text('作業日時', 'datetime')->data('datetimepicker', 'datetime') !!}

                    {!! BootForm::select('作物', 'product')->options(['スイカ', 'ほうれん草', '小松菜']) !!}
                    {!! BootForm::select('場所', 'place')->options(['A1', 'A2', 'A3'])->multiple() !!}

                    {!! BootForm::select('作業内容', 'work')
                            ->options(['防除', '定植', '整枝', '交配', '収穫']) !!}

                    <div class="form-group">
                        <label class="control-label">農薬</label>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>農薬名</th>
                                <th>
                                    農薬使用倍率/使用量
                                </th>
                                <th>
                                    操作
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>アファーム</td>
                                <td>
                                    1000
                                </td>
                                <td class="text-right">
                                    <a href="#" id="pesticide-remove" title="農薬を削除"
                                       class="btn btn-danger btn-xs">削除</a>
                                </td>
                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="text-right" colspan="2">
                                </td>
                                <td class="text-right" colspan="1">
                                    <a href="#" title="農薬を追加" data-dialog-content="#pesticide-form"
                                       class="btn btn-primary btn-xs">追加</a>
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>

                    {!! BootForm::submit('作成', 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="pesticide-form" class="hidden">
        {!! BootForm::open()->post()->action(route('workRecord.store')) !!}

        {!! BootForm::select('農薬名', '')
                ->options(['未選択', 'アファーム', 'カスケード']) !!}

        {!! BootForm::text('農薬使用倍率/使用量', '')->value(1000) !!}

        {!! BootForm::submit('追加', 'btn-primary btn-dialog') !!}

        {!! BootForm::close() !!}
    </div>
@endsection
