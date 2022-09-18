<?php

namespace App\Http\Requests\MetaAndSlug;

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
            'createdByUserId' => 'exist:users,id',
            'resourceId' => '',
            'type' => 'required|string',
            'routePath' => 'required|string',
            'slugPath' => 'string',
            'keywords' => ''
        ];
    }
}
