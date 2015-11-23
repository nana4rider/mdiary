@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->put()->action(route('workDiary.update', ['id' => $workDiary->id])) !!}

                    {!! BootForm::bind($workDiary) !!}

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

                    {!! BootForm::textarea(label('remarks'), 'remarks')->rows(config('const.remarks_rows')) !!}

                    {!! BootForm::checkbox(message('update_archive'), 'archive')->id('update-archive') !!}

                    {!! BootForm::submit(label('update'), 'btn-primary')
                        ->data('confirm', message('confirm.work_diary_archive'))
                        ->data('dialog-type', 'danger')->id('btn-update') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
