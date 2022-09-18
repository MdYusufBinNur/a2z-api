<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonSlugFeatures;
use App\Repositories\Contracts\RatingAndReviewRepository;
use App\Services\Rating\RatingService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use CommonModelFeatures, CommonSlugFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "createdByUserId",
        "parentId",
        "name",
        "surname",
        "shortIntroduction",
        "description",
        "categoryId",
        "subCategoryId",
        "brandId",
        "vendorId",
        "isActive",
    ];

    /**
     * get the brand
     *
     * @return HasOne
     */
    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brandId');
    }

    /**
     * get the parent product
     *
     * @return HasOne
     */
    public function parent()
    {
        return $this->hasOne(Product::class, 'id', 'parentId');
    }

    /**
     * get the category
     *
     * @return HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'categoryId');
    }

    /**
     * get the subCategory
     *
     * @return HasOne
     */
    public function subCategory()
    {
        return $this->hasOne(SubCategory::class, 'id', 'subCategoryId');
    }

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
     * get the vendors of the same product
     *
     * @return HasMany
     */
    public function vendors()
    {
        return $this->hasMany(Vendor::class, 'id', 'vendorId')->where('parentId', $this->productId);
    }

    /**
     * get the productRatingAndReviews
     *
     * @return hasOne
     */
    public function productOffer()
    {
        return $this->hasOne(ProductOffer::class, 'productId', 'id')->where('isActive', true)->latest();
    }

    /**
     * get the productStock
     *
     * @return HasOne
     */
    public function productStock()
    {
        return $this->hasOne(ProductStock::class, 'productId', 'id');
    }

    /**
     * get the productRatingAndReviews
     *
     * @return string
     */
    public function productPricing()
    {
        $productOfferObj = collect($this->productOffer);

        if($productOfferObj->isEmpty()) {
            return $this->productStock;
        } else {
            $productStockObj = collect($this->productStock);
            return (object) $productStockObj->merge($productOfferObj)->toArray();
        }
    }

    /**
     * get the productSpecsAndState
     *
     * @return HasOne
     */
    public function productSpecsAndState()
    {
        return $this->hasOne(ProductSpecsAndState::class, 'productId', 'id');
    }

    /**
     * get the productStockInLogs
     *
     * @return HasOne
     */
    public function productStockInLogLatest()
    {
        return $this->hasOne(ProductStockInLog::class, 'productId', 'id')
                ->where('vendorId', $this->vendorId)
                ->latest('created_at');
    }

    /**
     * get the productStockInLogs
     *
     * @return HasMany
     */
    public function productStockInLog()
    {
        return $this->hasMany(ProductStockInLog::class, 'productId', 'id')->where('vendorId', $this->vendorId);
    }

    /**
     * get the productStockOutLogs
     *
     * @return HasMany
     */
    public function productStockOutLog()
    {
//        return $this->hasMany(ProductStockOutLog::class, 'productId', 'id')->where('vendorId', $this->vendorId);
        return $this->hasMany(ProductStockOutLog::class, 'productId', 'id');
    }

    /**
     * get the productRatingAndReviews
     *
     * @return HasMany
     */
    public function productRatingAndReviews()
    {
        return $this->hasMany(RatingAndReview::class, 'productId', 'id')->where('type', RatingAndReview::TYPE_PRODUCT);
    }

    /**
     * get the Campaign
     */
    public function campaign()
    {
        return $this->productOffer->campaign();
    }

    /**
     * get the Campaign
     */
    public function getCampaignId()
    {
        return request('campaignId', $default = null);
    }

    /**
     * get the default viewing image of the product
     *
     * @return HasOne
     */
    public function image()
    {
        return $this->hasOne(Attachment::class, 'resourceId', 'id')
            ->where('type', Attachment::ATTACHMENT_TYPE_PRODUCT)
            ->where('variation', Attachment::ATTACHMENT_VARIATION_DEFAULT)
            ->latest();
    }

    /**
     * get all the images of the product
     *
     * @return HasMany
     */
    public function images()
    {
        return $this->hasMany(Attachment::class, 'resourceId', 'id')
            ->where('type', Attachment::ATTACHMENT_TYPE_PRODUCT);
    }
}
