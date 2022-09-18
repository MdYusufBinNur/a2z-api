<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'userId',
        'name',
        'phone',
        'division',
        'district',
        'area',
        'address',
        'updatedByUserId'
    ];

    /**
     * get the user
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'userId');
    }
}
