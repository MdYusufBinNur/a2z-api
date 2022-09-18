<?php

namespace App\Http\Requests\Role;

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
        return $rules = [
            'id'               => 'list:string',
            'title'            => 'list:string',
            'type'            => 'list:string',
        ];
    }

}
