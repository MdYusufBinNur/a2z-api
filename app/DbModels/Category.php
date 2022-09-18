<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonSlugFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use CommonModelFeatures, CommonSlugFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'similarCategories'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'similarCategories' => 'json'
    ];

    /**
     * Get the subCategories for the category.
     *
     * @return HasMany
     */
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class,'categoryId', 'id');
    }

    /**
     * Get the associate category image
     *
     * @return HasOne
     */
    public function image()
    {
        return $this->hasOne(Attachment::class,'resourceId', 'id')->where('type', Attachment::ATTACHMENT_TYPE_CATEGORY)->latest();
    }

}
