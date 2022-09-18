<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const GROUP_ENTIRE_PROPERTY = 'entire_property';
    const GROUP_ALL_RESIDENTS = 'all_residents';
    const GROUP_UNREGISTERED_USERS = 'registered_users';
    const GROUP_ALL_STAFFS = 'all_staffs';
    const GROUP_SPECIFIC_TOWER = 'specific_tower';
    const GROUP_SPECIFIC_FLOOR = 'specific_floor';
    const GROUP_SPECIFIC_LINE = 'specific_line';
    const GROUP_SPECIFIC_UNITS = 'specific_unit';
    const GROUP_ALL_TENANTS = 'all_tenants';
    const GROUP_ALL_OWNERS = 'all_owners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'fromUserId', 'toUserId', 'subject', 'isGroupMessage', 'group', 'groupNames', 'emailNotification', 'smsNotification', 'voiceNotification'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isGroupMessage' => 'boolean',
        'emailNotification' => 'boolean',
        'smsNotification' => 'boolean',
        'voiceNotification' => 'boolean',
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
     * get the message post related the message
     *
     * @return HasMany
     */
    public function messagePosts()
    {
        return $this->hasMany(MessagePost::class, 'messageId', 'id');
    }

    /**
     * get the message post related the message
     *
     * @return HasMany
     */
    public function scopeLastMessagePostOfTheUser($userId)
    {
        return $this->messagePostS()->where('fromUserId', $userId)->orderBy('created_at', 'desc');
    }

    /**
     * user and messages_users relationship
     *
     * @return HasMany
     */
    public function messageUsers()
    {
        return $this->hasMany(MessageUser::class, 'messageId', 'id');
    }

    /**
     * get the user
     *
     * @return HasOne
     */
    public function fromUser()
    {
        return $this->hasOne(User::class, 'id', 'fromUserId');
    }

    /**
     * get the attachments
     *
     * @return HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'resourceId')->where('type', Attachment::ATTACHMENT_TYPE_MESSAGE);
    }

    /**
     * notify able message-users for this message
     *
     * @return HasMany
     */
    public function notifyAbleMessageUsers()
    {
        return $this->messageUsers()->where('userId', '<>', $this->createdByUserId);
    }

    /**
     * message can be accessed by the user
     *
     * @param int $userId
     * @return bool
     */
    public function messageCanBeAccessedByTheUser(int $userId)
    {
        return in_array($userId, $this->messageUsers()->pluck('userId')->toArray());
    }

}
