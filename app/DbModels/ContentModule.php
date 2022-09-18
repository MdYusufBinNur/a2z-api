<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class ContentModule extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const TYPE_PRODUCT = 'product';
    const TYPE_SHOP = 'shop';
    const TYPE_BRAND = 'brand';
    const TYPE_OFFER = 'offer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'createdByUserId',
        'updatedByUserId',
        'categoryId',
        'subCategoryId',
        'title',
        'params',
        'type'
    ];

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
     */
    public function subCategory()
    {
        return $this->hasOne(SubCategory::class,'id','subCategoryId');
    }

    /**
     * get the subCategory
     */
    public function products()
    {
        $hasCategoryFilterQuery = !empty($this->categoryId) ? 'categoryId' . '='. $this->categoryId : '1 = 1';
        $hasSubCategoryFilterQuery = !empty($this->subCategoryId) ? 'subCategoryId' . '='. $this->subCategoryId : '1 = 1';

        $products = Product::selectRaw('*')
            ->whereRaw(DB::raw($hasCategoryFilterQuery))
            ->whereRaw(DB::raw($hasSubCategoryFilterQuery))
            ->whereRaw("name like ? OR surname like ? ", array('%'. $this->params.'%','%'. $this->params.'%'))
            ->orderBy('id', 'DESC')
            ->orderBy('created_at', 'DESC')->paginate(12);

        return $products;
    }

    /**
     * Get the associate brand image
     *
     * @return HasOne
     */
    public function image()
    {
        return $this->hasOne(Attachment::class,'resourceId', 'id')->where('type', Attachment::ATTACHMENT_TYPE_CONTENT_MODULE)->latest();
    }

}
