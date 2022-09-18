<?php

namespace App\DbModels\Traits\SuffixById;

use App\Services\Helpers\IdHashingHelper;
use Illuminate\Database\Eloquent\Model;

trait ProductIdDecode
{
    public function setProductIdAttribute($id)
    {
        $this->attributes['productId'] = IdHashingHelper::decode($id);
    }
}
