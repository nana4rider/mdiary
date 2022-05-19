<?php

namespace App\Http\Requests;

class WorkDiaryStoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'crop_id' => 'required',
            'field_ids' => 'required',
            'remarks' => 'max:1000'
        ];
    }
}
