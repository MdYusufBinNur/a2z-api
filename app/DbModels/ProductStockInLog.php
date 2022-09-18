<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;

class ProductStockInLog extends Model
{

    use CommonModelFeatures, CommonUuidFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "createdByUserId",
        "productId",
        "vendorId",
        "startingQuantity",
        "receivedQuantity",
        "availableQuantity",
        "note",
        "cost",
        "date",
    ];

}
