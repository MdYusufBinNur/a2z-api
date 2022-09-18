<?php

namespace App\Http\Requests\AdAndSliders;

use App\DbModels\AdAndSlider;
use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:string',
            'tag' => 'in:' . implode(',', AdAndSlider::getConstantsByPrefix('TAG_')),
            'type' => 'required|in:' . implode(',', AdAndSlider::getConstantsByPrefix('TYPE_')),
            'isActive' => 'required|boolean',
            'priority' => 'in:' . implode(',', AdAndSlider::getConstantsByPrefix('PRIORITY_')),
        ];
    }
}
