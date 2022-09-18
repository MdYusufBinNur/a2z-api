<?php

namespace App\DbModels\Traits\SuffixById;

use App\Services\Helpers\IdHashingHelper;
use Illuminate\Database\Eloquent\Model;

trait UpdatedByUserIdDecode
{
    public function setUpdatedByUserIdAttribute($id)
    {
        $this->attributes['updatedByUserId'] = IdHashingHelper::decode($id);
    }
}
