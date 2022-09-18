<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AdAndSlider extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const TYPE_SLIDERS = 'slider';
    const TYPE_AD = 'ad';

    const PRIORITY_FIRST = 'first';
    const PRIORITY_SECOND = 'second';
    const PRIORITY_THIRD = 'third';

    const TAG_NEW = 'new';
    const TAG_SALE = 'sale';
    const TAG_DISCOUNT = 'discount';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'title', 'type', 'description', 'vendorId', 'tag', 'priority', 'isActive',
    ];


    /**
     * get the vendor
     *
     * @return HasOne
     */
    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendorId');
    }

    /**
     * get the vendor
     *
     * @return HasOne
     */
    public function image()
    {
        return $this->hasOne(Attachment::class, 'resourceId', 'id')->where('type', $this->type);
    }

}
