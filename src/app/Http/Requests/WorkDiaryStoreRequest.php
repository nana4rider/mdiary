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
            'cropId' => 'required',
            'fieldIds' => 'required',
            'remarks' => 'max:1000'
        ];
    }
}
