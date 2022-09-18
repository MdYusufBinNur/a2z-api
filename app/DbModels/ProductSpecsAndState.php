<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;

class ProductSpecsAndState extends Model
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
        'specifications',
        'productStates'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'specifications' => 'json',
        'productStates' => 'json'
    ];

    /**
     * @var string[]
     */
    protected $attributes = [
        'specifications' => '[]',
        'productStates' => '[]'
    ];


    /**
     * toUserId setter
     *
     * @param $productStates
     */
    public function setProductStatesAttribute($productStates)
    {
        $this->attributes['productStates'] = json_encode($productStates);
    }

    /**
     * toUserId getter
     */
    public function getProductStatesAttribute()
    {
        return isset($this->attributes['productStates']) ? json_decode($this->attributes['productStates']) : [];
    }

    /**
     * toUserId setter
     *
     * @param $specifications
     */
    public function setSpecificationsAttribute($specifications)
    {
        $this->attributes['specifications'] = json_encode($specifications);
    }

    /**
     * toUserId getter
     */
    public function getSpecificationsAttribute()
    {
        return isset($this->attributes['specifications']) ? json_decode($this->attributes['specifications']) : [];
    }
}
