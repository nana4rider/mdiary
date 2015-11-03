@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! BootForm::open()->post()->action(route('workRecord.store')) !!}

                    {!! BootForm::text(label('datetime'), 'datetimeText')->data('datetimepicker', 'datetime') !!}

                    {!! BootForm::select(label('crop'), 'cropId')->options($cropOptions)
                            ->data('change-form-create', '') !!}

                    {!! BootForm::select(label('workField'), 'fieldIds')
                            ->options($workFieldOptions)->multiple()
                            ->helpBlock(nl2br(message('help.workRecordCreate.field'))) !!}

                    {!! BootForm::select(label('work'), 'workId')
                            ->options($workOptions)
                            ->data('change-form-create', '') !!}

                    @if($work->use_complete)
                        {!! BootForm::checkbox(label('workComplete'), 'complete') !!}
                    @endif

                    @if($work->id == \App\Models\Work::PEST_CONTROL)
                        <div class="form-group">
                            <label class="control-label">{{ label('pesticide') }}</label>

                            <div class="form-control-static">
                                <table class="table table-bordered">
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

                                    <tr>
                                        <td>アファーム</td>
                                        <td>
                                            1000
                                        </td>
                                        <td class="text-right">
                                            <a href="#" id="pesticide-remove"
                                               title="{{ message('deleteTo', ['name' => 'pesticide']) }}"
                                               class="btn btn-danger btn-xs">{{ label('destroy') }}</a>
                                        </td>
                                    </tr>

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
                        </div>
                    @endif

                    {!! BootForm::submit('作成', 'btn-primary') !!}

                    {!! BootForm::submit('changeForm', 'hidden')
                            ->formaction(route('workRecord.create.changeForm'))->id('change-form-submit') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="pesticide-section" class="hidden">
        {!! BootForm::open()->post()->action(route('workRecord.store'))->id('pesticide-form') !!}

        {!! BootForm::select(label('pesticideName'), 'pesticideId')
                ->options($pesticideOptions) !!}

        {!! BootForm::inputGroup(label('pesticideUsage'), 'usage')->value(1000)
                ->afterAddon('*')->helpBlock('') !!}

        {!! BootForm::submit(label('add'), 'btn-primary btn-dialog') !!}

        {!! BootForm::close() !!}
    </div>
@endsection

@section('js')
    <script>
        var pesticides = {!! $pesticidesJson !!};
    </script>
    <script src="{{ url('js/workRecord.create.js') }}"></script>
@endsection