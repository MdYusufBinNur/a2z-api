<?php

namespace App\Http\Requests\ContentModule;

use App\DbModels\ContentModule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'updatedByUserId' => 'exists:users,id',
            'categoryId' => 'exists:categories,id',
            'subCategoryId' => 'exists:sub_categories,id',
            'title' => 'required|min:3',
            'params' => 'nullable',
            'type' => 'required|in:'  . implode(',', ContentModule::getConstantsByPrefix('TYPE_')),
        ];
    }
}
