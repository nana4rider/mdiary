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
            'remarks' => 'max:1000'
        ];
    }
}
