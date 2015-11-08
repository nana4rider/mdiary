@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($workDiary->archive)
                        <div class="text-right">
                            <small>
                                <span class="label label-warning">{{ label('archived') }}</span>
                            </small>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label">
                            {{ label('createDate') }}
                        </label>

                        <p class="form-control-static">
                            {{ $workDiary->created_at->format(config('format.date')) }}
                        </p>
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            {{ label('crop') }}
                        </label>

                        <p class="form-control-static">
                            {{ $workDiary->crop->name }}
                        </p>
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            {{ label('workField') }}
                        </label>

                        <p class="form-control-static">
                            {{ $workDiary->workField->name }}
                        </p>
                    </div>

                    <div class="form-group">
                        <label class="control-label">
                            {{ label('remarks') }}
                        </label>

                        <p class="form-control-static">
                            {!! nl2br(e($workDiary->remarks)) !!}
                        </p>
                    </div>

                    <div class="form-group">
                        <label class="control-label">
                            作業記録
                        </label>

                        <div class="form-control-static">
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
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">
                            農薬使用記録
                        </label>

                        <div class="form-control-static">
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
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
