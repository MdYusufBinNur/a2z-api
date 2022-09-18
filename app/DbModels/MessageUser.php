<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MessageUser extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const FOLDER_INBOX = 'inbox';
    const FOLDER_SENT = 'sent';
    const FOLDER_INBOX_SENT = 'inbox-sent';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'messageId', 'userId', 'folder', 'isRead'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isRead' => 'boolean',
    ];

    /**
     * get the property related to the user's role
     *
     * @return hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the user
     *
     * @return hasOne
     */
    public function message()
    {
        return $this->hasOne(Message::class, 'id', 'messageId');
    }

    /**
     * get the user
     *
     * @return hasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }
}
