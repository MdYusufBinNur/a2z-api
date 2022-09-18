<?php

namespace App\DbModels\Traits\SuffixById;

use App\Services\Helpers\IdHashingHelper;
use Illuminate\Database\Eloquent\Model;

trait VendorIdDecode
{
    public function setVendorIdAttribute($id)
    {
        $this->attributes['vendorId'] = IdHashingHelper::decode($id);
    }
}
