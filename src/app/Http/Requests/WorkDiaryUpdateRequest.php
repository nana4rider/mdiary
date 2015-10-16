<?php

namespace App\Http\Requests;

class WorkDiaryUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fieldIds' => 'required',
            'remarks' => 'max:1000'
        ];
    }
}
