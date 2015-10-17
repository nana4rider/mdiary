@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->get() !!}

                    {!! BootForm::bind($data) !!}

                    {!! BootForm::select(label('workField'), 'fieldIds')
                            ->options($workFieldOptions)->multiple() !!}

                    {!! BootForm::checkbox('アーカイブ済みの作業日誌を含む', 'archive') !!}

                    {!! BootForm::submit('検索', 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">作業日誌</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>作成日時</th>
                            <th>作物</th>
                            <th>圃場</th>
                            <th>アーカイブ</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($workDiaries as $index => $workDiary)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $workDiary->created_at->format(config('format.date')) }}</td>
                                <td>{{ $workDiary->crop->name }}</td>
                                <td>{{ $workDiary->workField->name }}</td>
                                <td>
                                    @if($workDiary->archive)
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @endif
                                </td>
                                <td>
                                    {!! BootForm::open()->get() !!}

                                    {!! BootForm::submit(label('show'), 'btn-primary btn-xs')
                                        ->formaction(route('workDiary.show', ['id' => $workDiary->id])) !!}

                                    @if(!$workDiary->archive)
                                        {!! BootForm::submit(label('edit'), 'btn-primary btn-xs')
                                            ->formaction(route('workDiary.edit', ['id' => $workDiary->id])) !!}

                                        {!! BootForm::submit(label('delete'), 'btn-danger btn-xs')
                                            ->formaction(route('workDiary.destroy', ['id' => $workDiary->id]))
                                            ->data('method', 'delete')->data('confirm', message('deleteConfirm'))
                                            ->data('dialog-type', 'danger') !!}
                                    @endif

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
                    'fieldIds' => Request::get('fieldIds'),
                    'archive' => Request::get('archive')
                ])->render() !!}
            </nav>
        </div>
    </div>
@endsection
