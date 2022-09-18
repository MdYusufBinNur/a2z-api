<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reminder extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const REMINDER_TYPE_EMAIL = 'email';
    const REMINDER_TYPE_SMS = 'sms';
    const REMINDER_TYPE_NOTIFICATION_FEED = 'notification_feed';

    const RESOURCE_TYPE_PAYMENT = 'payment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'toUserIds', 'reminderType', 'resourceType', 'resourceId',
    ];

    /**
     * get the details based on type
     *
     * @return HasOne
     */
    public function detailByType()
    {
        return !empty($this->getDetailClassByType())
            ? $this->hasOne($this->getDetailClassByType(), 'id', 'resourceId')
            : null;
    }

    /**
     * post has different types,
     * get the relationship class by types
     *
     * @return string
     */
    private function getDetailClassByType()
    {
        $detailClass = '';
        switch ($this->resourceType) {
            case self::RESOURCE_TYPE_PAYMENT:
                $detailClass = Payment::class;
                break;
        }
        return $detailClass;
    }
}
