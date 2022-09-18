<?php

namespace App\Http\Requests\MetaAndSlug;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'updatedByUserId' => 'exist:users,id',
            'resourceId' => '',
            'type' => 'string',
            'routePath' => 'string',
            'slugPath' => 'string',
            'keywords' => ''
        ];
    }
}
