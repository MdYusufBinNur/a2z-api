<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Expense extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId','categoryId','expenseReason', 'amount', 'notes', 'expenseDate', 'propertyId'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expenseDate' => 'datetime: Y-m-d',
    ];

    /**
     * get the guest type
     *
     * @return HasOne
     */
    public function category()
    {
        return $this->hasOne(ExpenseCategory::class, 'id', 'categoryId');
    }

}
