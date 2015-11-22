@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->get() !!}

                    {!! BootForm::bind(Request::all()) !!}

                    {!! BootForm::select(label('crop'), 'crop_id')->options($crops->lists('name', 'id')) !!}

                    {!! BootForm::select(label('work_content'), 'work_id')
                            ->options($works->lists('name', 'id'))->multiple()
                            ->helpBlock(message('unselected_search_all', ['name' => 'work_content'])) !!}

                    {!! BootForm::select(label('work_field'), 'field_ids')
                            ->options($workFields->lists('name', 'id'))->multiple()
                            ->helpBlock(message('unselected_search_all', ['name' => 'work_field'])) !!}

                    {!! BootForm::submit(label('search'), 'btn-primary')->id('search') !!}

                    {!! BootForm::submit('', 'hidden')->data('ajax', 'json')->data('method', 'get')
                            ->id('change-form-submit') !!}

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
