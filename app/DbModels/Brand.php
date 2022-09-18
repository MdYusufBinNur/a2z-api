<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonSlugFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Brand extends Model
{
    use CommonModelFeatures, CommonSlugFeatures;

    const TAG_NEW = "new";
    const TAG_OLD = "old";
    const TAG_POPULAR = "popular";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createByUserId',
        'title',
        'tag',
        'categoryId',
        'ownerName',
        'address'
    ];

    /**
     * toUserId setter
     *
     * @param $tag
     */
    public function setTagAttribute($tag)
    {
        $this->attributes['tag'] = !empty($tag) ? $tag : self::TAG_NEW;
    }

    /**
     * Get the properties for the company.
     *
     * @return HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class,'id', 'categoryId');
    }

    /**
     * Get the associate brand image
     *
     * @return HasOne
     */
    public function image()
    {
        return $this->hasOne(Attachment::class,'resourceId', 'id')->where('type', Attachment::ATTACHMENT_TYPE_BRAND)->latest();
    }


    /**
     * get the productRatingAndReviews
     *
     * @return HasOne
     */
    public function productOffer()
    {
        $campaignId = request('campaignId', $default = null);

        return $this->hasOne(ProductOffer::class, 'brandId', 'id')->where('campaignId', $campaignId)->latest();
    }
}
