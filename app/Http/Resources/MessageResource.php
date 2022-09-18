<?php

namespace App\Http\Resources;


class MessageResource extends Resource
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
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'message.property'), function () {
                return new PropertyResource($this->property);
            }),
            'fromUserId' => $this->fromUserId,
            'fromUser' => $this->when($this->needToInclude($request, 'message.fromUser'), function () {
                return new UserResource($this->fromUser);
            }),
            'toUserId' => $this->toUserId,
            'subject' => $this->subject,
            'isGroupMessage' => $this->isGroupMessage,
            'group' => $this->group,
            'groupNames' => $this->groupNames,
            'emailNotification' => $this->emailNotification,
            'smsNotification' => $this->smsNotification,
            'messagePosts' => $this->when($this->needToInclude($request, 'message.posts'), function () {
                return new MessagePostResourceCollection($this->messagePosts);
            }),
            'attachments' => $this->when($this->needToInclude($request, 'message.attachments'), function () {
                return new AttachmentResourceCollection($this->attachments);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
