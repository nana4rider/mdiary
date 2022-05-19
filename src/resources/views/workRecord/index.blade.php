@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->get() !!}

                    {!! BootForm::bind(Request::all()) !!}

                    {!! BootForm::select(label('crop'), 'crop_id')->options($crops->lists('name', 'id')) !!}

                    {!! BootForm::select(label('work_field'), 'field_ids')
                            ->options($workFields->lists('name', 'id'))->multiple()
                            ->helpBlock(message('unselected_search_all', ['name' => 'work_field'])) !!}

                    {!! BootForm::select(label('work_content'), 'work_ids')
                            ->options($works->lists('name', 'id'))->multiple()
                            ->helpBlock(message('unselected_search_all', ['name' => 'work_content'])) !!}

                    {!! BootForm::checkbox(message('work_diary_with_archive'), 'archive') !!}

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
                            <th>{{ label('work_date') }}</th>
                            <th>{{ label('work_content') }}</th>
                            <th>{{ label('work_diary_id') }}</th>
                            <th>{{ label('work_field') }}</th>
                            <th>{{ label('action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($workRecords as $index => $workRecord)
                            @foreach($workRecord->workDiaries as $wdIndex => $workDiary)
                                <tr>
                                    {{-- */$rowspan = $workRecord->workDiaries->count()/* --}}
                                    @if($wdIndex === 0)
                                        <td rowspan="{{ $rowspan }}">{{ $index + 1 }}</td>
                                        <td rowspan="{{ $rowspan }}">
                                            {{ $workRecord->datetime->format(config('format.datetime')) }}
                                        </td>
                                        <td rowspan="{{ $rowspan }}">
                                            @include('workRecord.workContent')
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{ route('workDiary.show', ['id' => $workDiary->id]) }}"
                                           title="{{ label('route.work_diary.show') }}">{{ $workDiary->view_id }}</a>
                                    </td>
                                    <td>{{ $workDiary->workField->name }}</td>
                                    @if($wdIndex === 0)
                                        <td rowspan="{{ $rowspan }}">
                                            {!! BootForm::open()->delete()->action(route('workRecord.destroy', ['id' => $workRecord->id])) !!}

                                            <a href="{{ route('workRecord.edit', ['id' => $workRecord->id]) }}"
                                               class="btn btn-primary btn-xs">{{ label('edit') }}</a>

                                            {!! BootForm::submit(label('destroy'), 'btn-danger btn-xs')
                                                ->data('confirm', message('confirm.delete'))
                                                ->data('dialog-type', 'danger') !!}

                                            {!! BootForm::close() !!}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <nav class="text-center">
        {!! $workRecords->appends([
            'crop_id' => Request::get('crop_id'),
            'field_ids' => Request::get('field_ids'),
            'work_ids' => Request::get('work_ids')
        ])->render() !!}
    </nav>
@endsection
