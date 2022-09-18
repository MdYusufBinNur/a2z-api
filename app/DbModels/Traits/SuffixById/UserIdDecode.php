<?php

namespace App\DbModels\Traits\SuffixById;

use App\Services\Helpers\IdHashingHelper;
use Illuminate\Database\Eloquent\Model;

trait UserIdDecode
{
    public function setUserIdAttribute($userId)
    {
        $this->attributes['userId'] = IdHashingHelper::decode($userId);
    }
}
