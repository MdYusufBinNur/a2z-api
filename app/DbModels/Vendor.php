<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonSlugFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vendor extends Model
{
    use CommonModelFeatures, CommonSlugFeatures;


    const TAG_NEW = 'new';
    const TAG_POPULAR = 'popular';
    const TAG_PREMIUM = 'premium';
    const TAG_REGULAR = 'regular';


    const TYPE_ELECTRONICS = 'electronics';
    const TYPE_GROCERIES = 'groceries';
    const TYPE_CLOTHES = 'clothes';
    const TYPE_FISH_AND_MEATS = 'fish-meats';
    const TYPE_VEGETABLES = 'vegetables';
    const TYPE_SWEET_AND_BAKERIES = 'sweet-bakeries';
    const TYPE_FASHION_CLOTHS = 'fashion-cloths';
    const TYPE_VEHICLES = 'vehicles';
    const TYPE_MOBILES = 'mobiles';
    const TYPE_COMPUTERS = 'computers';
    const TYPE_SUPER_SHOP = 'super-shop';
    const TYPE_HOME_APPLIANCES = 'home-appliances';


    /**
     * Table name
     * @var string
     */
    protected $fillable = [
        'createdByUserId',
        'propertyId',
        'name',
        'email',
        'subCategoryIds',
        'phone',
        'address',
        'website',
        'billingInfo',
        'additionalNote',
        'tag',
        'type',
        'userId',
        'userRoleId',
        'acceptPaymentMethods'
    ];


    /**
     * subCategoryIds setter
     *
     * @param $subCategoryIds
     */
    public function setSubCategoryIdsAttribute($subCategoryIds)
    {
        $subCategoryIds = array_map('intval', $subCategoryIds);

        $this->attributes['subCategoryIds'] = json_encode($subCategoryIds);
    }

    /**
     * subCategoryIds getter
     */
    public function getSubCategoryIdsAttribute()
    {
        return isset($this->attributes['subCategoryIds']) ? json_decode($this->attributes['subCategoryIds']) : [];
    }

    /**
     * acceptPaymentMethods getter
     */
    public function getAcceptPaymentMethodsAttribute()

    {
        return isset($this->attributes['acceptPaymentMethods']) ? explode(",", $this->attributes['acceptPaymentMethods']) : [];
    }

    /**
     * default tag setters
     * @param $tag
     */
    public function setTagAttribute($tag)
    {
        $this->attributes['tag'] = !empty($tag) ? $tag : self::TAG_NEW;
    }

    /**
     * get the user
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * get the productOffer
     *
     * @return HasOne
     */
    public function productOffer()
    {
        $campaignId = request('campaignId', $default = null);

        return $this->hasOne(ProductOffer::class, 'vendorId', 'id')->where('campaignId', $campaignId)->latest();
    }


    /**
     * Get the associate vendor image
     *
     * @return HasOne
     */
    public function image()
    {
        return $this->hasOne(Attachment::class,'resourceId', 'id')->where('type', Attachment::ATTACHMENT_TYPE_VENDOR)->latest();
    }
}
