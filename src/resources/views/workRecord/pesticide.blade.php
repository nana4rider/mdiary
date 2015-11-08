@foreach(Session::get('workRecord.pesticides', collect()) as $workPestControl)
    <tr id="pesticide-row-{{ $workPestControl->get('pesticide_id') }}">
        <td>{{ $workPestControl->get('pesticide_name') }}</td>
        <td>
            {{ $workPestControl->get('usage') }}{{ $workPestControl->get('unit_name') }}
        </td>
        <td class="text-right">
            <button type="submit" class="btn btn-danger btn-xs delete-pesticide"
                    data-ajax="html"
                    title="{{ message('delete_to', ['name' => 'pesticide']) }}"
                    data-pesticide-id="{{ $workPestControl->get('pesticide_id') }}"
                    formaction="{{ route('workRecord.create.deletePesticide', ['pesticide_id' => $workPestControl->get('pesticide_id')]) }}">
                {{ label('destroy') }}
            </button>
        </td>
    </tr>
@endforeach
