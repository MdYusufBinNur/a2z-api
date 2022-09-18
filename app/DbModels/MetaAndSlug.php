<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;

class MetaAndSlug extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const TYPE_BRAND = 'brand';
    const TYPE_CATEGORY = 'category';
    const TYPE_SUB_CATEGORY = 'sub-category';
    const TYPE_VENDOR = 'vendor';
    const TYPE_PRODUCT = 'product';
    const TYPE_CAMPAIGN = 'campaign';

    const ROUTE_PATH_BRAND = '/brands/';
    const ROUTE_PATH_CATEGORY = '/categories/c/';
    const ROUTE_PATH_SUB_CATEGORY = '/categories/sc/';
    const ROUTE_PATH_VENDOR = '/shops/';
    const ROUTE_PATH_PRODUCT = '/products/';
    const ROUTE_PATH_CAMPAIGN = '/campaigns/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'resourceId',
        'type',
        'routePath',
        'slugPath',
        'keywords',
        'updatedByUserId',
    ];
}
