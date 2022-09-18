<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tag extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'productId',
        'title',
        'type',
        'value',
    ];

    /**
     * get the property
     *
     * @return hasOne
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'productId');
    }
}
