<?php

namespace App\DbModels\Traits;

use App\Services\Helpers\IdHashingHelper;
use Illuminate\Support\Str;

trait CommonUuidFeatures
{
    use CommonIdHashingFeatures;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function getRouteKeyName()
    {
//         return 'uuid';
        return 'id';
    }

    public function getIdOrUuid()
    {
//        return empty($this->uuid) ? $this->id : $this->uuid;
        return IdHashingHelper::encode($this->id);
    }
}
