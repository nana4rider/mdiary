@extends('layouts.auth')

@section('title', label('workDiary.index'))

@section('content')
    <h1 class="page-header">検索条件</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->get() !!}

                    {!! BootForm::select('場所', 'place')
                            ->options(['A1', 'A2', 'A3', 'A4', 'A5'])->multiple() !!}

                    {!! BootForm::checkbox('アーカイブ済みを含む', 'archive') !!}

                    {!! BootForm::submit('検索', 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
                <!--/panel content-->
            </div>
            <!--/panel-->
        </div>
    </div>

    <h1 class="page-header">@yield('title')</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        #99
                        <span class="text-muted"><small>場所:</small></span>A3
                        <span class="text-muted"><small>作物:</small></span>スイカ
                        <span class="label label-success pull-right">アーカイブ済み</span>
                    </h3>
                </div>
                <div class="panel-body">
                    <h5>作業記録</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>作業日時</th>
                                <th>作業内容</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ date(config('format.date')) }}</td>
                                <td>播種</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>{{ date(config('format.date')) }}</td>
                                <td>整枝</td>
                            </tr>
                            <tr>
                                <td>3</td>
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

                    <h5>農薬使用記録</h5>

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

                    <h5>備考</h5>

                    <p>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                    </p>

                    {!! BootForm::open()->get()->action(url('workDiary/1/edit')) !!}

                    {!! BootForm::submit('編集', 'btn-primary') !!}

                    {!! BootForm::close() !!}
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
