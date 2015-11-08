@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post()->action(route('workRecord.store')) !!}

                    {!! BootForm::text(label('datetime'), 'datetimeInput')->type('datetime-local') !!}

                    {!! BootForm::select(label('crop'), 'cropId')->options($cropOptions)
                            ->data('change-form-create', '') !!}

                    {!! BootForm::select(label('workDiary'), 'workDiaryIds')
                            ->options($workDiaryOptions)->multiple()
                            ->helpBlock(message('help.workRecordCreate.workDiary')) !!}

                    {!! BootForm::select(label('workContent'), 'workId')
                            ->options($workOptions)
                            ->data('change-form-create', '') !!}

                    {{-- 播種、定植 --}}
                    @if($work->use_seeding)
                        {!! BootForm::select(label('cultivar'), 'cultivarId')->options($cultivarOptions) !!}

                        {!! BootForm::inputGroup(label('intrarowSpacing'), 'intrarowSpacing')
                                ->type('number')->afterAddon('cm') !!}
                    @endif

                    {{-- 農薬 --}}
                    @if($work->use_pest_control)
                        <div class="form-group{{ $errors->has('pesticide') ? ' has-error' : '' }}">
                            <label class="control-label">{{ label('pesticide') }}</label>

                            <div class="form-control-static">
                                <table class="table table-bordered" id="pesticide-table">
                                    <thead>
                                    <tr>
                                        <th>{{ label('pesticideName') }}</th>
                                        <th>
                                            {{ label('pesticideUsage') }}
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
                                            <a href="#" title="{{ message('addTo', ['name' => 'pesticide']) }}"
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
                        {!! BootForm::checkbox(label('workComplete'), 'complete')
                                ->helpBlock(message('help.workRecordCreate.workComplete')) !!}
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

            {!! BootForm::select(label('pesticideName'), 'pesticideId')->options($pesticideOptions) !!}

            {!! BootForm::inputGroup(label('pesticideUsage'), 'pesticideUsage')->type('number')->afterAddon('*') !!}

            {!! BootForm::submit(label('add'), 'btn-primary btn-dialog')->data('ajax', 'html')
            ->id('add-pesticide') !!}

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