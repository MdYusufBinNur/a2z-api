<?php

namespace App\Http\Requests\Vendor;

use App\DbModels\Vendor;
use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'createdByUserId' => 'exists:users,id',
            'name' => 'max:255',
            'email' => 'max:255',
            'phone' => 'max:20',
            'subCategoryIds' => [new ListOfIds('sub_categories', 'id')],
            'address' => 'max:255',
            'website' => 'max:255',
            'billingInfo' => 'max:65535',
            'additionalNote' => 'max:65535',
            'tag' => 'in:' . implode(',', Vendor::getConstantsByPrefix('TAG_')),
            'type' => 'required|in:'. implode(',', Vendor::getConstantsByPrefix('TYPE_')),
            'userId' => 'exists:users,id',
            'userRoleId' => 'exists:user_roles,id',
            'acceptPaymentMethods' => 'list:string'
        ];
    }
}
