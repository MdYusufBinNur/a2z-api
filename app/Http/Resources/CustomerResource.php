<?php

namespace App\Http\Resources;


class CustomerResource extends Resource
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
            'resourceId' => $this->when($this->needToInclude($request, 'customer.resourceId'), function () {
                return $this->id;
            }),
            'createdByUserId' => $this->createdByUserId,
            'name' => $this->name,
            'email' =>$this->email,
            'phone' => $this->phone,
            'title' => $this->title,
            'level' => $this->level,
            'userRoleId' => $this->userRoleId,
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'customer.user'), function () {
                return new UserResource($this->user);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
