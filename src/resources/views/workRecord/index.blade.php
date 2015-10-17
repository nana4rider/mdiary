@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->get() !!}

                    {!! BootForm::select('作物', 'product')->options(['スイカ', 'ほうれん草', '小松菜'])->multiple() !!}

                    {!! BootForm::select('場所', 'place')
                            ->options(['A1', 'A2', 'A3', 'A4', 'A5'])->multiple() !!}

                    {!! BootForm::select('作業内容', 'work')
                            ->options(['防除', '定植', '整枝', '交配', '収穫'])->multiple() !!}

                    {!! BootForm::submit('検索', 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>

            <div class="panel panel-default">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>作物</th>
                            <th>場所</th>
                            <th>作業日時</th>
                            <th>作業内容</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>スイカ</td>
                            <td>A1, A2</td>
                            <td>{{ date(config('format.date')) }}</td>
                            <td>播種</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>スイカ</td>
                            <td>A3, A4</td>
                            <td>{{ date(config('format.date')) }}</td>
                            <td>整枝</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>スイカ</td>
                            <td>A5, A6, B1</td>
                            <td>{{ date(config('format.date')) }}</td>
                            <td>
                                <a href="#"
                                   title="防除詳細"
                                   data-dialog-content="#work-record-99">防除</a>

                                <div id="work-record-99" class="hidden">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>農薬名</th>
                                                <th>農薬使用倍率/使用量</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>アファーム</td>
                                                <td>1000</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>カスケード</td>
                                                <td>1000</td>
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

    <nav class="text-center">
        <ul class="pagination">
            <li class="disabled"><span>«</span></li>
            <li class="active"><span>1</span></li>
            <li><a href="?page=2">2</a></li>
            <li><a href="?page=3">3</a></li>
            <li><a href="?page=4">4</a></li>
            <li><a href="?page=5">5</a></li>
            <li><a href="?page=6">6</a></li>
            <li><a href="?page=7">7</a></li>
            <li><a href="?page=8">8</a></li>
            <li class="disabled"><span>...</span></li>
            <li><a href="?page=13">13</a></li>
            <li><a href="?page=14">14</a></li>
            <li><a href="?page=2" rel="next">»</a></li>
        </ul>
    </nav>

@endsection
