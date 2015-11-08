<?php

namespace App\Http\Requests;

use App\Models\Pesticide;

class WorkRecordAddPesticideRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $minUsage = 0;
        $maxUsage = 0;

        if (!empty($this->input('pesticide_id'))) {
            $pesticide = Pesticide::findOrFail($this->input('pesticide_id'));
            $minUsage = $pesticide->minimum_usage;
            $maxUsage = $pesticide->maximum_usage;
        }

        return [
            'pesticide_id' => 'required',
            'pesticide_usage' => 'required|numeric|between:' . $minUsage . ',' . $maxUsage
        ];
    }
}
