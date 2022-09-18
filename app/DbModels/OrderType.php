<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;

class OrderType extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const TYPE_REGULAR = 'regular';
    const TYPE_EXPRESS = 'express';
    const TYPE_PRE_ORDER = 'pre_order';
    const TYPE_CAMPAIGN = 'campaign';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'title',
    ];
}
