@foreach(Session::get('workRecord.workPestControls', []) as $workPestControl)
    <tr id="pesticide-row-{{ $workPestControl->pesticideId }}">
        <td>{{ $workPestControl->pesticide->name }}</td>
        <td>
            {{ $workPestControl->usage }}{{ $workPestControl->pesticide->unit->name }}
        </td>
        <td class="text-right">
            <button type="submit" class="btn btn-danger btn-xs delete-pesticide"
                    data-ajax="html"
                    title="{{ message('deleteTo', ['name' => 'pesticide']) }}"
                    data-pesticide-id="{{ $workPestControl->pesticideId }}"
                    formaction="{{ route('workRecord.create.deletePesticide', ['pesticideId' => $workPestControl->pesticideId]) }}">
                {{ label('destroy') }}
            </button>
        </td>
    </tr>
@endforeach
