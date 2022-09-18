<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserResource extends Resource
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
            'resourceId' => $this->when($this->needToInclude($request, 'user.resourceId'), function () {
                return $this->id;
            }),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'locale' => $this->locale,
            'isActive' => $this->isActive,
            'notificationSeenAt' => $this->notificationSeenAt,
            'roles' => $this->when($this->needToInclude($request, 'user.roles'), function () {
                return new UserRoleResourceCollection($this->userRoles);
            }),
            'customer' => $this->when($this->needToInclude($request, 'user.customer'), function () {
                return new CustomerResource($this->customer);
            }),
            'staff' => $this->when($this->needToInclude($request, 'user.staff'), function () {
                return new StaffResource($this->staff);
            }),
            'admin' => $this->when($this->needToInclude($request, 'ul.admin'), function () {
                return new AdminResource($this->admin);
            }),
            'profilePic' => $this->when($this->needToInclude($request, 'user.profilePic'), function () {
                return new AttachmentResource($this->profilePic);
            }),
            'userProfile' => $this->when($this->needToInclude($request, 'user.userProfile'), function () {
                return new UserProfileResource($this->userProfile);
            }),
            'userLabel' => $this->when($this->needToInclude($request, 'user.userLabel'), function () {
                return $this->getUserLabel($this->userRoles);
            }),
            'userNotificationSettings' => $this->when($this->needToInclude($request, 'user.userNotificationSettings'), function () {
                return new UserNotificationSettingResource($this->userNotificationSettings);
            }),
            'userAccount' => $this->when($this->needToInclude($request, 'user.userAccount'), function () {
                return new UserAccountResource($this->userAccount);
            }),
            'lastLoginAt' => $this->lastLoginAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
