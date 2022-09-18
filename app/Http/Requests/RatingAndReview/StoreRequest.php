<?php

namespace App\Http\Requests\RatingAndReview;

use App\DbModels\RatingAndReview;
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
            'productId' => 'required_without:vendorId|exists:products,id',
            'vendorId' => 'required_without:productId|exists:vendors,id',
            'rating' => 'required_without:comments|numeric|gt:0|lte:5',
            'type' => 'required|in:'. implode(',', RatingAndReview::getConstantsByPrefix('TYPE_')),
            'comments' => 'required_without:rating',
            'createdByUserId' => 'exists:users,id',
        ];
    }
}
