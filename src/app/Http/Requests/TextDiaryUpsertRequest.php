<?php

namespace App\Http\Requests;

class TextDiaryUpsertRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'datetime_input' => 'required|date_format:"' . config('format.input.datetime-local') . '"',
            'title' => 'required|max:100',
            'body' => 'required|max:10000',
            'category_ids' => 'required',
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        // 写真のバリデーション
        $validator->each('picture', 'image');
        $pictureKeys = $this->getPictureKeys();

        $attributeNames = [];
        foreach ($pictureKeys as $key) {
            $attributeNames['picture.' . $key] = label('picture');
        }
        $validator->setAttributeNames($attributeNames);

        $validator->after(function ($validator) use (&$pictureKeys) {
            $messages = $validator->messages();
            foreach ($pictureKeys as $key) {
                if ($messages->has('picture.' . $key)) {
                    // BootFormで表示できるよう、pictureにメッセージをコピー
                    $validator->errors()->add('picture', $messages->first('picture.' . $key));
                    return;
                }
            }
        });

        return $validator;
    }

    protected function getPictureKeys()
    {
        return array_keys((array)$this->files->all()['picture']);
    }
}
