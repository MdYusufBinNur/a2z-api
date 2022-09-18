<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;


class AppFooterResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getIdOrUuid(),
            'createdByUserId' => $this->createdByUserId,
            'title' => $this->title,
            'content' => $this->content,
            'details' => $this->details,
            'link' => $this->link,
            'image' => $this->when($this->needToInclude($request, 'appFooter.image'), function () {
                return new AttachmentResource($this->image);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
