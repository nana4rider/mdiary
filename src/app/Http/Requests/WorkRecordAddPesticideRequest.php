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

        if (!empty($this->input('pesticideId'))) {
            $pesticide = Pesticide::findOrFail($this->input('pesticideId'));
            $minUsage = $pesticide->minimum_usage;
            $maxUsage = $pesticide->maximum_usage;
        }

        return [
            'pesticideId' => 'required',
            'pesticideUsage' => 'required|numeric|between:' . $minUsage . ',' . $maxUsage
        ];
    }
}
