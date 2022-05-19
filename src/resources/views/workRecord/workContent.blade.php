@if($workRecord->work->use_seeding)
    {{-- 播種/定植記録 --}}
    {{ $workRecord->work->name }}
    ({{ $workRecord->workSeeding->cultivar->name . ', ' .
        $workRecord->workSeeding->intrarow_spacing .
        label('intrarow_spacing_unit') }})
@elseif($workRecord->work->use_pest_control)
    {{-- 防除記録 --}}
    <a href="#"
       title="{{ $workRecord->work->name . label('detail') }}"
       data-dialog-content="#work-record-{{ $workRecord->id }}">
        {{ $workRecord->work->name }}</a>

    <div id="work-record-{{ $workRecord->id }}" class="hidden">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        {{ label('pesticide_name') }}
                    </th>
                    <th>
                        {{ label('pesticide_usage') }}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($workRecord->workPestControls as $index => $workPestControl)
                    <tr>
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td>
                            {{ $workPestControl->pesticide->name }}
                        </td>
                        <td>
                            {{ $workPestControl->usage .
                               $workPestControl->pesticide->unit->name }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    {{ $workRecord->work->name }}
@endif