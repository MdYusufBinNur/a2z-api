<?php

namespace App\Http\Requests\Vendor;

use App\DbModels\Vendor;
use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:20',
            'subCategoryIds' => [new ListOfIds('sub_categories', 'id')],
            'address' => 'max:255',
            'website' => 'max:255',
            'billingInfo' => 'max:65535',
            'additionalNote' => 'max:65535',
            'tag' => 'nullable|in:' . implode(',', Vendor::getConstantsByPrefix('TAG_')),
            'type' => 'required|in:'. implode(',', Vendor::getConstantsByPrefix('TYPE_')),
            'userId' => 'required_without:user|exists:users,id|unique_with:vendors,userId,level=level',
            'acceptPaymentMethods' => 'list:string',
            'user' => '',
            'user.email' => 'required_without:phone|email|unique:users,email|max:255',
            'user.phone' => 'required_without:email|unique:users,phone',
            'user.name' => 'required_with:user|max:255',
            'user.password' => 'required_with:user|min:6|max:255',
        ];
    }
}
