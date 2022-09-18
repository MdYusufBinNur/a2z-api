<?php

namespace App\DbModels\Traits;

use App\DbModels\MetaAndSlug;
use App\Services\Helpers\IdHashingHelper;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

trait CommonSlugFeatures
{
    use CommonIdHashingFeatures;

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $nameOrTitleSlug = $model->hasAttribute('name') ? $model->name : $model->title;
            $model->slug = Str::slug(strtolower($nameOrTitleSlug), '-') . '-' . Str::random(7);

            $model->uuid = (string) Str::uuid();
        });
    }

    public function hasAttribute($attr)
    {
        return array_key_exists($attr, $this->attributes);
    }

    public function getRouteKeyName()
    {
         return 'slug';
//        return 'id';
    }

    public function getIdOrUuid()
    {
//        return empty($this->uuid) ? $this->id : $this->uuid;
        return IdHashingHelper::encode($this->id);
    }

    /**
     * get the productRatingAndReviews
     *
     * @return HasOne
     */
    public function metaAndSlug()
    {
        return $this->hasOne(MetaAndSlug::class, 'resourceId', 'id');
    }
}
