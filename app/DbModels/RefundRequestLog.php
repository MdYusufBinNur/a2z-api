<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RefundRequestLog extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'refundRequestId',
        'status',
        'comment',
        'assignedToUserId'
    ];

    /**
     * get the order
     *
     * @return HasOne
     */
    public function assignedToUser()
    {
        return $this->hasOne(User::class, 'id', 'assignedToUserId');
    }

    /**
     * get the order
     *
     * @return HasOne
     */
    public function refundRequest()
    {
        return $this->hasOne(RefundRequest::class, 'id', 'refundRequestId');
    }

    /**
     * get the user
     *
     * @return HasOne
     */
    public function updatedByUser()
    {
        return $this->hasOne(User::class, 'id', 'updatedByUserId');
    }
}
