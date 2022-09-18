<?php

namespace App\DbModels\Traits\SuffixById;

use App\Services\Helpers\IdHashingHelper;
use Illuminate\Database\Eloquent\Model;

trait CategoryIdDecode
{
    public function setCategoryIdAttribute($id)
    {
        $this->attributes['categoryId'] = IdHashingHelper::decode($id);
    }
}
