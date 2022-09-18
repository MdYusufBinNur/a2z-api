<?php

namespace App\Http\Resources;


class MessagePostResource extends Resource
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
            'message' => $this->when($this->needToInclude($request, 'mp.message'), function () {
                return new MessageResource($this->message);
            }),
            'fromUserId' => $this->fromUserId,
            'fromUser' => $this->when($this->needToInclude($request, 'mp.fromUser'), function () {
                return new UserResource($this->fromUser);
            }),
            'text' => $this->text,
            'attachments' => $this->when($this->needToInclude($request, 'mp.attachments'), function () {
                return new AttachmentResourceCollection($this->attachments);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
