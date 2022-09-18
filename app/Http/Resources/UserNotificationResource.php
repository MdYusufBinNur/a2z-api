<?php

namespace App\Http\Resources;


use App\Repositories\Contracts\UserNotificationRepository;

class UserNotificationResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getIdOrUuid(),
            'createdByUserId' => $this->createdByUserId,
            'typeId' => $this->userNotificationTypeId,
            'type' => $this->when($this->needToInclude($request, 'un.type'), function () {
                return new UserNotificationTypeResource($this->type);
            }),
            'resourceId' => $this->resourceId,
            'fromUserId' => $this->fromUserId,
            'fromUser' => $this->when($this->needToInclude($request, 'un.fromUser'), function () {
                return new UserResource($this->fromUser);
            }),
            'fromVendorId' => $this->fromVendorId,
            'fromVendor' => $this->when($this->needToInclude($request, 'un.fromVendor'), function () {
                return new VendorResource($this->fromVendor);
            }),
            'toUserId' => $this->toUserId,
            'toUser' => $this->when($this->needToInclude($request, 'un.toUser'), function () {
                return new UserResource($this->toUser);
            }),
            'message' => $this->message,
            'readStatus' => $this->readStatus,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
