<?php

namespace App\Http\Requests;

use App\Models\Work;

class WorkRecordStoreRequest extends Request
{
    protected $work = null;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validateData = [
            'datetime_input' => 'required|date_format:"' . config('format.input.datetime-local') . '"',
            'crop_id' => 'required',
            'work_diary_ids' => 'required',
            'work_id' => 'required',
        ];

        if (!empty($this->input('work_id'))) {
            $this->work = Work::findOrFail($this->input('work_id'));

            if ($this->work->use_seeding) {
                // 播種、定植の場合に追加で必須にする属性
                $validateData['cultivar_id'] = 'required';
                $validateData['intrarow_spacing'] = 'required|numeric|between:1,100';
            }
        }

        return $validateData;
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        if (is_null($this->work)) {
            return $validator;
        }

        if ($this->work->crops->where('id', $this->input('crop_id'))->isEmpty()) {
            // 作業内容の選択が不正
            $validator->after(function ($validator) {
                $validator->errors()->add('work_id',
                    trans('validation.required', ['attribute' => trans('validation.attributes.work_id')]));
            });
        }

        if ($this->work->use_pest_control) {
            if (empty(session()->get('workRecord.pesticides'))) {
                // 農薬が未選択
                $validator->after(function ($validator) {
                    $validator->errors()->add('pesticide',
                        trans('validation.required', ['attribute' => trans('validation.attributes.pesticide')]));
                });
            }
        }

        return $validator;
    }

}
