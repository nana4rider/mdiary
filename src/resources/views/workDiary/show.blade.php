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
                            {{ label('work_diary_id') }}
                        </label>

                        <p class="form-control-static">
                            {{ $workDiary->view_id }}
                        </p>
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            {{ label('create_date') }}
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
                            {{ label('work_field') }}
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
                            {{ label('work_record') }}
                        </label>

                        <div class="form-control-static">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ label('work_date') }}</th>
                                        <th>{{ label('work_content')  }}</th>
                                        <th>{{ label('work_complete')  }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($workRecords as $index => $workRecord)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $workRecord->datetime->format(config('format.datetime')) }}</td>
                                            <td>
                                                @include('workRecord.workContent')
                                            </td>
                                            <td>
                                                @if($workRecord->complete)
                                                    <span class="glyphicon glyphicon-ok"></span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">
                            {{ label('pesticide_summary') }}
                        </label>

                        <div class="form-control-static">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ label('pesticide_name') }}</th>
                                        <th>{{ label('usage_count') }}</th>
                                        <th>{{ label('latest_usage_date') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pesticideSummary as $index => $data)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $data->pesticide_name }}</td>
                                            <td>
                                                {{ $data->usage_count }}
                                                ({{ message('max_times', [], ['value' => $data->max_usage_count]) }})
                                            </td>
                                            <td>{{ $data->latest_datetime->format(config('format.date')) }}</td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
