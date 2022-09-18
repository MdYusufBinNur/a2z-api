<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class CategoryResource extends Resource
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
            'slug' => $this->slug,
            'resourceId' => $this->when($this->needToInclude($request, 'category.resourceId'), function () {
                return $this->id;
            }),
            'createdByUserId' => $this->createdByUserId,
            'name' => $this->name,
            'subCategories' => $this->when($this->needToInclude($request, 'category.subCategories'), function () {
                return new SubCategoryResourceCollection($this->subCategories);
            }),
            'image' => $this->when($this->needToInclude($request, 'category.image'), function () {
                return new AttachmentResource($this->image);
            }),
            'similarCategories' => $this->similarCategories,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
