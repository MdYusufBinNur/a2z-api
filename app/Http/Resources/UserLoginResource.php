<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserLoginResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getIdOrUuid(),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'locale' => $this->locale,
            'isActive' => $this->isActive,
            'roles' => $this->when($this->needToInclude($request, 'ul.roles'), function () {
                return new UserRoleResourceCollection($this->userRoles);
            }),
            'customer' => $this->when($this->needToInclude($request, 'ul.customer'), function () {
                return new CustomerResource($this->customer);
            }),
            'staff' => $this->when($this->needToInclude($request, 'ul.staff'), function () {
                return new StaffResource($this->staff);
            }),
            'profilePic' => $this->when($this->needToInclude($request, 'ul.profilePic'), function () {
                return new AttachmentResource($this->profilePic);
            }),
            'userNotificationSettings' => $this->when($this->needToInclude($request, 'ul.userNotificationSettings'), function () {
                return new UserNotificationSettingResource($this->userNotificationSettings);
            }),
            'userProfile' => $this->when($this->needToInclude($request, 'ul.userProfile'), function () {
                return new UserProfileResource($this->userProfile);
            }),
            'lastLoginAt' => $this->lastLoginAt,
            'notificationSeenAt' => $this->notificationSeenAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
