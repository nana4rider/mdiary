@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post()->action(route('workDiary.store')) !!}

                    {!! BootForm::select(label('crop'), 'crop_id')->options($cropOptions) !!}

                    {!! BootForm::select(label('work_field'), 'field_ids')
                            ->options($workFieldOptions)->multiple()
                            ->helpBlock(nl2br(message('help.work_diary_create.field'))) !!}

                    {!! BootForm::textarea(label('remarks'), 'remarks')->rows(config('const.remarks_rows')) !!}

                    {!! BootForm::submit(label('store'), 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
                <!--/panel content-->
            </div>
            <!--/panel-->
        </div>
    </div>

@endsection
