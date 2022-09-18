<?php

namespace App\Http\Requests\Staff;

use App\DbModels\Role;
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
            'roleId' => 'in:' . Role::ROLE_STAFF_STANDARD['id'] . ',' . Role::ROLE_STAFF_LIMITED['id'],
            'userId' => 'list:string',
            'query' => ''
        ];
    }
}
