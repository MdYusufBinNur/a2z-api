<?php

namespace App\Http\Resources;


class AdminResource extends Resource
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
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'admin.user'), function () {
                return new UserResource($this->user);
            }),
            'level' => $this->level,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
