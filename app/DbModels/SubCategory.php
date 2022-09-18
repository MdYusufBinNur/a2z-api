<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonSlugFeatures;
use Illuminate\Database\Eloquent\Model;
use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubCategory extends Model
{
    use CommonModelFeatures, CommonSlugFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoryId',
        'name',
    ];

        /**
     * get the user's role
     *
     * @return HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'categoryId');
    }

    /**
     * Get the associate subCategory image
     *
     * @return HasOne
     */
    public function image()
    {
        return $this->hasOne(Attachment::class,'resourceId', 'id')->where('type', Attachment::ATTACHMENT_TYPE_SUB_CATEGORY)->latest();
    }
}
