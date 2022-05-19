@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->get() !!}

                    {!! BootForm::bind(Request::all()) !!}

                    {!! BootForm::select(label('work_field'), 'field_ids')
                            ->options($workFields->lists('name', 'id'))->multiple()
                            ->helpBlock(message('unselected_search_all', ['name' => 'work_field'])) !!}

                    {!! BootForm::checkbox(message('work_diary_with_archive'), 'archive') !!}

                    {!! BootForm::submit(label('search'), 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>


            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ label('work_diary_id') }}</th>
                            <th>{{ label('create_date') }}</th>
                            <th>{{ label('crop') }}</th>
                            <th>{{ label('work_field') }}</th>
                            <th>{{ label('archive') }}</th>
                            <th>{{ label('action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($workDiaries as $index => $workDiary)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('workDiary.show', ['id' => $workDiary->id]) }}"
                                       title="{{ label('route.work_diary.show') }}">{{ $workDiary->view_id }}</a>
                                </td>
                                <td>{{ $workDiary->created_at->format(config('format.date')) }}</td>
                                <td>{{ $workDiary->crop->name }}</td>
                                <td>{{ $workDiary->workField->name }}</td>
                                <td>
                                    @if($workDiary->archive)
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @endif
                                </td>
                                <td>
                                    {!! BootForm::open()->delete()->action(route('workDiary.destroy', ['id' => $workDiary->id])) !!}

                                    @if(!$workDiary->archive)
                                        <a href="{{ route('workDiary.edit', ['id' => $workDiary->id]) }}"
                                           class="btn btn-primary btn-xs">{{ label('edit') }}</a>
                                    @endif

                                    {!! BootForm::submit(label('destroy'), 'btn-danger btn-xs')
                                        ->data('confirm', message('confirm.delete'))
                                        ->data('dialog-type', 'danger') !!}

                                    {!! BootForm::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <nav class="text-center">
                {!! $workDiaries->appends([
                    'field_ids' => Request::get('field_ids'),
                    'archive' => Request::get('archive')
                ])->render() !!}
            </nav>
        </div>
    </div>
@endsection
