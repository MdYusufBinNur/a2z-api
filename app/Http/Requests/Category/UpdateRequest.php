<?php

namespace App\Http\Requests\Category;

use App\Rules\CSVString;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->segment(4);
        return [
            'name' => '',
            'similarCategories' => [new CSVString()]
        ];
    }
}
