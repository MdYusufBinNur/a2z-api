<?php

namespace App\Http\Resources;


class MessageUserResource extends Resource
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
            'messageId' => $this->messageId,
            'message' => $this->when($this->needToInclude($request, 'mu.message'), function () {
                return new MessageResource($this->message);
            }),
            'userId' => $this->userId,
            'user' => $this->when($this->needToInclude($request, 'mu.user'), function () {
                return new UserResource($this->user);
            }),
            'folder' => $this->folder,
            'isRead' => $this->isRead,
        ];
    }
}
