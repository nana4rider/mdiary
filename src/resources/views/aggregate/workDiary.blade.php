@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->get() !!}

                    {!! BootForm::select('場所', 'place')
                            ->options(['A1', 'A2', 'A3', 'A4', 'A5'])->multiple() !!}

                    {!! BootForm::submit('検索', 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">作業記録</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>管理作業名(適用期)</th>
                            <th>開始年月</th>
                            <th>終了年月</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>施肥</td>
                            <td>{{ date(config('format.dateSimple')) }}</td>
                            <td>{{ date(config('format.dateSimple')) }}</td>
                        </tr>
                        <tr>
                            <td>播種</td>
                            <td>{{ date(config('format.dateSimple')) }}</td>
                            <td>{{ date(config('format.dateSimple')) }}</td>
                        </tr>
                        <tr>
                            <td>収穫開始日</td>
                            <td>{{ date(config('format.dateSimple')) }}</td>
                            <td>{{ date(config('format.dateSimple')) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">防除記録</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>農薬</th>
                            <th>倍率/使用量</th>
                            <th>使用前日数</th>
                            <th>使用回数</th>
                            <th>倍率または使用量</th>
                            @for ($i = 1; $i <= 5; $i++)
                                <th>{{ $i }}回目</th>
                            @endfor
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>アリエッティ水和剤</td>
                            <td>1500倍</td>
                            <td>収穫前1日</td>
                            <td>2回</td>
                            <td>1500倍</td>
                            @for ($i = 1; $i <= 5; $i++)
                                <td>{{ date(config('format.dateSimple')) }}</td>
                            @endfor
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
