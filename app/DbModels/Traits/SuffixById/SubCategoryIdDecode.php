<?php

namespace App\DbModels\Traits\SuffixById;

use App\Services\Helpers\IdHashingHelper;
use Illuminate\Database\Eloquent\Model;

trait SubCategoryIdDecode
{
    public function setSubCategoryIdAttribute($id)
    {
        $this->attributes['subCategoryId'] = IdHashingHelper::decode($id);
    }
}
