<?php

namespace App\DbModels\Traits\SuffixById;

use App\Services\Helpers\IdHashingHelper;
use Illuminate\Database\Eloquent\Model;

trait BrandIdDecode
{
    public function setBrandIdAttribute($id)
    {
        $this->attributes['brandId'] = IdHashingHelper::decode($id);
    }
}
