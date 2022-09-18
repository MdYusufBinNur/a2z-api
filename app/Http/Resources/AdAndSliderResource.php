<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class AdAndSliderResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getIdOrUuid(),
            'resourceId' => $this->when($this->needToInclude($request, 'adAndSlider.resourceId'), function () {
                return $this->id;
            }),
            'createdByUserId' => $this->createdByUserId,
            'vendorId' => $this->vendorId,
            'vendor' => $this->when($this->needToInclude($request, 'adAndSlider.vendor'), function () {
                return new VendorResource($this->vendor);
            }),
            'image' => $this->when($this->needToInclude($request, 'adAndSlider.image'), function () {
                return new AttachmentResource($this->image);
            }),
            'title' => $this->title,
            'vendorName' => $this->vendor ? $this->vendor->name : null,
            'description' => $this->description,
            'type' => $this->type,
            'tag' => $this->tag,
            'priority' => $this->priority,
            'isActive' => $this->isActive,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
