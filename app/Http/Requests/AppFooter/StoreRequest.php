<?php

namespace App\Http\Requests\AppFooter;

use App\DbModels\AppFooter;
use App\Http\Requests\Request;
use ReflectionException;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws ReflectionException
     */
    public function rules()
    {
        return [
            'title' => 'string',
            'content' => 'in:'. implode(',', AppFooter::getConstantsByPrefix('CONTENT_')),
            'link' => 'string',
            'details' => 'string',
        ];
    }
}
