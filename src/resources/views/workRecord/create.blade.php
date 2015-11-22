@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post()->action(route('workRecord.store')) !!}

                    {!! BootForm::text(label('datetime'), 'datetime_input')->type('datetime-local') !!}

                    {!! BootForm::select(label('crop'), 'crop_id')->options($cropOptions)
                            ->data('change-form-create', '') !!}

                    {!! BootForm::select(label('work_diary'), 'work_diary_ids')
                            ->options($workDiaryOptions)->multiple()
                            ->helpBlock(message('help.work_record_create.work_diary')) !!}

                    {!! BootForm::select(label('work_content'), 'work_id')
                            ->options($workOptions)
                            ->data('change-form-create', '') !!}

                    {{-- 播種、定植 --}}
                    @if($work->use_seeding)
                        {!! BootForm::select(label('cultivar'), 'cultivar_id')->options($cultivarOptions) !!}

                        {!! BootForm::inputGroup(label('intrarow_spacing'), 'intrarow_spacing')
                                ->type('number')->afterAddon(label('intrarow_spacing_unit')) !!}
                    @endif

                    {{-- 農薬 --}}
                    @if($work->use_pest_control)
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
                    @endif

                    {{-- 完了チェック --}}
                    @if($work->use_complete)
                        {!! BootForm::checkbox(label('work_complete'), 'complete')
                                ->helpBlock(message('help.work_record_create.work_complete')) !!}
                    @endif

                    {!! BootForm::submit(label('store'), 'btn-primary') !!}

                    {!! BootForm::submit('changeForm', 'hidden')
                            ->formaction(route('workRecord.create.changeForm'))->id('change-form-submit') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>

    @if($work->use_pest_control)
        <div id="pesticide-section" class="hidden">
            {!! BootForm::open()->post()->action(route('workRecord.create.addPesticide'))->id('pesticide-form') !!}

            {!! BootForm::select(label('pesticide_name'), 'pesticide_id')->options($pesticideOptions) !!}

            {!! BootForm::inputGroup(label('pesticide_usage'), 'pesticide_usage')->type('number')->afterAddon('*') !!}

            {!! BootForm::submit(label('add'), 'btn-primary btn-dialog')->data('ajax', 'html')->id('add-pesticide') !!}

            {!! BootForm::close() !!}
        </div>
    @endif
@endsection

@section('js')
    @if($work->use_pest_control)
        <script>
            {!! 'var pesticides = ' . $pesticidesJson . ';' !!}
        </script>
    @endif
    <script src="{{ url('js/workRecord.create.js') }}"></script>
@endsection