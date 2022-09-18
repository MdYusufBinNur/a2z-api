<?php

namespace App\DbModels\Traits;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\SoftDeletes;

trait CommonModelFeatures
{
    //todo experiment model caching
    use SoftDeletes, CommonModelHelperFeatures, Cachable;
    //used in Cachable
    protected $cachePrefix = "pms-model-cache";
}
