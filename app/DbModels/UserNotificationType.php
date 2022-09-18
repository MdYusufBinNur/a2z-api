<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;

class UserNotificationType extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    protected $fillable = [
        'createdByUserId', 'type', 'description'
    ];

    const GENERIC = ['id' => 1, 'type' => 'generic'];
    const DAILY_DIGEST = ['id' => 2, 'type' => 'daily_digest'];
    const MESSAGE = ['id' => 3, 'type' => 'message'];
    const REMINDER = ['id' => 4, 'type' => 'reminder'];
    const ANNOUNCEMENT = ['id' => 5, 'type' => 'announcement'];
    const OFFER = ['id' => 6, 'type' => 'offer'];
    const UPGRADE = ['id' => 7, 'type' => 'upgrade'];

    const ORDER_REQUEST = ['id' => 8, 'type' => 'order_request'];
    const ORDER_PENDING = ['id' => 8, 'type' => 'order_pending'];
    const ORDER_CONFIRMED = ['id' => 9, 'type' => 'order_confirmed'];
    const ORDER_PROCESSING = ['id' => 10, 'type' => 'order_processing'];
    const ORDER_COMPLETED = ['id' => 11, 'type' => 'order_completed'];
    const ORDER_PICKED = ['id' => 12, 'type' => 'order_picked'];
    const ORDER_SHIPPED = ['id' => 13, 'type' => 'order_shipped'];
    const ORDER_DELIVERED = ['id' => 14, 'type' => 'order_delivered'];
    const ORDER_CANCELLED = ['id' => 15, 'type' => 'order_cancelled'];

    const PAYMENT_ITEM_CREATED = ['id' => 16, 'type' => 'payment_item_created'];
    const PAYMENT_ITEM_UPDATED = ['id' => 17, 'type' => 'payment_item_updated'];
}
