<?php

namespace App\Http\Requests\AdAndSliders;

use App\DbModels\AdAndSlider;
use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'createdByUserId' => 'exists:users,id',
            'vendorId' => 'exists:vendors,id',
            'title' => 'min:3|max:255',
            'description' => 'min:3|max:255',
            'tag' => 'required|in:' . implode(',', AdAndSlider::getConstantsByPrefix('TAG_')),
            'type' => 'required|in:' . implode(',', AdAndSlider::getConstantsByPrefix('TYPE_')),
            'isActive' => 'boolean',
            'priority' => 'required|in:' . implode(',', AdAndSlider::getConstantsByPrefix('PRIORITY_')),
        ];
    }
}
