<?php

namespace App\Http\Resources;


class FeedbackResource extends Resource
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
            'createdByUserId' => $this->createdByUserId,
            'createdByUser' => $this->when($this->needToInclude($request, 'feedback.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'category' => $this->category,
            'feedbackText' => $this->feedbackText,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'attachments' => $this->when($this->needToInclude($request, 'feedback.attachments'), function () {
                return new AttachmentResourceCollection($this->attachments);
            }),
        ];
    }
}
