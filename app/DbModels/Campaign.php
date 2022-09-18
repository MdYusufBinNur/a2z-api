<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonSlugFeatures;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use CommonModelFeatures, CommonSlugFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createByUserId',
        'updatedByUserId',
        'title',
        'description',
        'host',
        'startDate',
        'startTime',
        'endDate',
        'endTime',
        'isActive'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isActive' => 'boolean'
    ];
}
