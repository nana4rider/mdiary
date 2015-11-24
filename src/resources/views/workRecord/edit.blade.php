@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post()->action(route('workRecord.store')) !!}

                    {!! BootForm::bind($workRecord) !!}

                    {!! BootForm::text(label('datetime'), 'datetime_input')->type('datetime-local') !!}

                    <div class="form-group">
                        <label class="control-label">
                            {{ label('crop') }}
                        </label>

                        <p class="form-control-static">
                            {{ $workRecord->crop->name }}
                        </p>
                    </div>

                    {!! BootForm::select(label('work_diary'), 'work_diary_ids')
                            ->options($workDiaries->lists('name', 'id'))->multiple()
                            ->helpBlock(message('help.work_record_create.work_diary')) !!}

                    <div class="form-group">
                        <label class="control-label">
                            {{ label('work_content') }}
                        </label>

                        <p class="form-control-static">
                            {{ $workRecord->work->name }}
                        </p>
                    </div>

                    {{-- 完了チェック --}}
                    <div id="option-complete" class="hidden">
                        {!! BootForm::checkbox(label('work_complete'), 'complete')
                                ->helpBlock(message('help.work_record_create.work_complete')) !!}
                    </div>

                    {{-- 播種、定植 --}}
                    <div id="option-seeding" class="hidden">
                        {!! BootForm::select(label('cultivar'), 'cultivar_id')->options($cultivars->lists('name', 'id')) !!}

                        {!! BootForm::inputGroup(label('intrarow_spacing'), 'intrarow_spacing')
                                ->type('number')->afterAddon(label('intrarow_spacing_unit')) !!}
                    </div>

                    {{-- 農薬 --}}
                    <div id="option-pest-control" class="hidden">
                        <div class="form-group{{ $errors->has('pesticide') ? ' has-error' : '' }}">
                            <label class="control-label">{{ label('pesticide') }}</label>

                            <div class="form-control-static">
                                <table class="table table-bordered" id="pesticide-table">
                                    <thead>
                                    <tr>
                                        <th>
                                            {{ label('pesticide_name') }}
                                        </th>
                                        <th>
                                            {{ label('pesticide_usage') }}
                                        </th>
                                        <th>
                                            {{ label('action') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @include('workRecord.pesticide')
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="text-right" colspan="3">
                                            <a href="#" title="{{ message('add_to', ['name' => 'pesticide']) }}"
                                               data-dialog-content="#pesticide-section"
                                               class="btn btn-primary btn-xs">{{ label('add') }}</a>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            @if($errors->has('pesticide'))
                                <p class="help-block">{{ $errors->first('pesticide') }}</p>
                            @endif
                        </div>
                    </div>

                    {!! BootForm::submit(label('update'), 'btn-primary') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="pesticide-section" class="hidden">
        {!! BootForm::open()->post()->action(route('workRecord.create.addPesticide'))->id('pesticide-form') !!}

        {!! BootForm::select(label('pesticide_name'), 'pesticide_id')->options($pesticides->lists('name', 'id')) !!}

        {!! BootForm::inputGroup(label('pesticide_usage'), 'pesticide_usage')->type('number')->afterAddon('*') !!}

        {!! BootForm::submit(label('add'), 'btn-primary btn-dialog')->data('ajax', 'html')->id('add-pesticide') !!}

        {!! BootForm::close() !!}
    </div>
@endsection

@section('js')
    <script>
        {!! 'var pesticides = ' . $pesticides->toJson() . ';' !!}
        {!! 'var work = ' . $workRecord->work->toJson() . ';' !!}
    </script>
@endsection