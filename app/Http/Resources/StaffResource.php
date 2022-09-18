<?php

namespace App\Http\Resources;


class StaffResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getIdOrUuid(),
            'contactEmail' => $this->contactEmail,
            'phone' => $this->phone,
            'title' => $this->title,
            'level' => $this->level,
            'userRoleId' => $this->userRoleId,
            'userId' => $this->userId,
            'name' => $this->user->name,
            'user' => $this->when($this->needToInclude($request, 'staff.user'), function () {
                return new UserResource($this->user);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'label' => $this->staffLabel,
        ];
    }
}
