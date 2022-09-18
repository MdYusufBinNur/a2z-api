<?php

namespace App\Http\Resources;

use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserNotificationResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'totalUnreadMessages' => app(UserNotificationRepository::class)->countUnreadNotificationOfTheCurrentUser()
            ]
        ];
    }
}
