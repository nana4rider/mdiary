@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->get() !!}

                    {!! BootForm::select('作物', 'product')->options(['スイカ', 'ほうれん草', '小松菜']) !!}

                    {!! BootForm::submit('検索', 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
                <!--/panel content-->
            </div>
            <!--/panel-->
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>場所</th>
                            <th>品種</th>
                            <th>株間</th>
                            <th>播種日</th>
                            <th>収穫日</th>
                            <th>収穫日数</th>
                            <th>残効日数</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>A1</td>
                            <td>スクープ</td>
                            <td>5cm</td>
                            <td>{{ date(config('format.date')) }}</td>
                            <td>{{ date(config('format.date')) }}</td>
                            <td>40</td>
                            <td>
                                <a href="#" title="農薬使用記録" data-dialog-content="#pesticide-summary-99">7</a>

                                <div id="pesticide-summary-99" class="hidden">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>農薬名</th>
                                                <th>使用回数</th>
                                                <th>最終使用日</th>
                                                <th>残効日数</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>アファーム</td>
                                                <td class="warning">4/5</td>
                                                <td>{{ date(config('format.date')) }}</td>
                                                <td class="success">0</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>アルバリン</td>
                                                <td class="danger">5/5</td>
                                                <td>{{ date(config('format.date')) }}</td>
                                                <td class="danger">7</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
