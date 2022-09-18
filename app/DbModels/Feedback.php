<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Feedback extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    protected $table = 'feedbacks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propertyId',
        'createdByUserId',
        'category',
        'feedbackText',
        'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * get feedback property
     *
     * @return HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get user's profile picture
     *
     * @return HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'resourceId', 'id')->where('type', Attachment::ATTACHMENT_TYPE_FEEDBACK);
    }
}
